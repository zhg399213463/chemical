<?php

namespace app\system\admin;

use app\system\model\SystemInquiryOrder as InquiryModel;
use app\system\model\SystemInquiryOrderItem as ItemModel;
use app\system\model\SystemProduct as ProductModel;
use think\Db;

class Inquiry extends Admin
{
    public $tabData = [];
    protected $hisiTable = 'SystemInquiry';

    protected function initialize()
    {
        parent::initialize();
    }

    public function index($q = '')
    {
        if ($this->request->isAjax()) {
            $page  = $this->request->param('page/d', 1);
            $limit = $this->request->param('limit/d', 15);

            $query = InquiryModel::order('id', 'desc');

            $catalog = $this->request->param('catalog/s', '');
            if ($catalog !== '') {
                $query->where('catalog', 'like', '%' . $catalog . '%');
            }
            $cas = $this->request->param('cas/s', '');
            if ($cas !== '') {
                $query->where('cas', 'like', '%' . $cas . '%');
            }
            $name = $this->request->param('name/s', '');
            if ($name !== '') {
                $query->where('product_name', 'like', '%' . $name . '%');
            }

            $supplier = $this->request->param('supplier/s', '');
            if ($supplier !== '') {
                $ids = ItemModel::where('supplier', 'like', '%' . $supplier . '%')->column('inquiry_order_id');
                $ids = array_unique(array_filter(array_map('intval', $ids)));
                if (empty($ids)) {
                    return json(['code' => 0, 'msg' => '', 'count' => 0, 'data' => []]);
                }
                $query->where('id', 'in', $ids);
            }

            $count = (clone $query)->count();
            $list  = $query->page($page, $limit)->select();

            $rows = [];
            foreach ($list as $order) {
                $arr = $order->toArray();
                $items = ItemModel::where('inquiry_order_id', $order->id)->order('sort_order', 'asc')->select();
                $suppliers = [];
                foreach ($items as $it) {
                    if ($it['supplier'] !== '') {
                        $suppliers[] = $it['supplier'];
                    }
                }
                $arr['quote_count'] = count($items);
                if (count($suppliers) <= 2) {
                    $arr['supplier_summary'] = implode('、', $suppliers);
                } else {
                    $arr['supplier_summary'] = $suppliers[0] . '、' . $suppliers[1] . '…共' . count($suppliers) . '家';
                }
                $rows[] = $arr;
            }

            return json(['code' => 0, 'msg' => '', 'count' => $count, 'data' => $rows]);
        }

        $assign                = [];
        $assign['hisiTabData'] = $this->tabData;
        $assign['hisiTabType'] = 1;
        return $this->assign($assign)->fetch();
    }

    public function add()
    {
        if ($this->request->isAjax() && !$this->request->isPost()) {
            $catalog = trim((string)$this->request->param('lookup_catalog/s', ''));
            if ($catalog !== '') {
                return $this->jsonProductByCatalog($catalog);
            }
        }

        if ($this->request->isPost()) {
            $post = $this->request->post();
            list($ok, $msg, $items) = $this->parseAndValidateItems($post);
            if (!$ok) {
                return $this->error($msg);
            }

            $catalog = trim((string)($post['catalog'] ?? ''));
            $cas     = trim((string)($post['cas'] ?? ''));
            if ($catalog === '' || $cas === '') {
                return $this->error('请填写货号与CAS号');
            }

            $product = ProductModel::where('catalog', $catalog)->find();
            if (!$product) {
                return $this->error('货号不存在，请重新输入');
            }

            $productName = trim((string)$product['name']);
            if ($productName === '') {
                $productName = $catalog;
            }

            $lastId = InquiryModel::order('id desc')->value('id');
            $inquiryNo = $this->generateOrderNo((int)$lastId + 1);

            try {
                Db::transaction(function () use ($inquiryNo, $catalog, $cas, $productName, $items) {
                    $order = InquiryModel::create([
                        'inquiry_no'   => $inquiryNo,
                        'catalog'      => $catalog,
                        'cas'          => $cas,
                        'product_name' => $productName,
                    ]);
                    $this->saveItems((int)$order->id, $items);
                });
            } catch (\Throwable $e) {
                return $this->error('添加失败');
            }

            return $this->success('保存成功', url('index'));
        }

        $this->assign('formData', []);
        $this->assign('itemsJson', []);
        $this->assign('isEdit', false);
        return $this->fetch('form');
    }

    public function edit($id = 0)
    {
        $id = (int)($this->request->isPost() ? $this->request->post('id/d', 0) : $this->request->param('id/d', $id));
        if ($id <= 0) {
            return $this->error('参数错误');
        }

        $order = InquiryModel::where('id', $id)->find();
        if (!$order) {
            return $this->error('记录不存在');
        }

        if ($this->request->isPost()) {
            $post = $this->request->post();
            list($ok, $msg, $items) = $this->parseAndValidateItems($post);
            if (!$ok) {
                return $this->error($msg);
            }

            $product = ProductModel::where('catalog', $order['catalog'])->find();
            $productName = $product ? trim((string)$product['name']) : '';
            if ($productName === '') {
                $productName = $order['catalog'];
            }

            try {
                Db::transaction(function () use ($order, $productName, $items) {
                    InquiryModel::where('id', $order['id'])->update([
                        'product_name' => $productName,
                    ]);
                    ItemModel::where('inquiry_order_id', $order['id'])->delete();
                    $this->saveItems((int)$order['id'], $items);
                });
            } catch (\Throwable $e) {
                return $this->error('修改失败');
            }

            return $this->success('修改成功', url('index'));
        }

        $row = $order->toArray();
        $itemRows = ItemModel::where('inquiry_order_id', $id)->order('sort_order', 'asc')->select();
        $items = [];
        foreach ($itemRows as $it) {
            $items[] = $it->toArray();
        }

        $this->assign('formData', $row);
        $this->assign('itemsJson', $items);
        $this->assign('isEdit', true);
        return $this->fetch('form');
    }

    public function del()
    {
        $ids   = $this->request->param('id/a');
        $model = new InquiryModel();
        if ($model->del($ids)) {
            return $this->success('删除成功');
        }
        return $this->error($model->getError());
    }

    private function generateOrderNo($id)
    {
        $yearMonth = date('Ym');
        $paddedId  = str_pad((string)$id, 10, '0', STR_PAD_LEFT);
        return $yearMonth . $paddedId;
    }

    /**
     * @return array [bool ok, string msg, array items]
     */
    private function parseAndValidateItems(array $post)
    {
        $raw = isset($post['items']) && is_array($post['items']) ? $post['items'] : [];
        if (count($raw) > 10) {
            return [false, '最多支持10个供应商报价', []];
        }

        $items = [];
        $sort  = 0;
        foreach ($raw as $row) {
            if (!is_array($row)) {
                continue;
            }
            $supplier = isset($row['supplier']) ? trim((string)$row['supplier']) : '';
            if ($supplier === '') {
                continue;
            }
            $sort++;
            if ($sort > 10) {
                return [false, '最多支持10个供应商报价', []];
            }
            $items[] = [
                'sort_order'          => $sort,
                'supplier_id'         => (int)($row['supplier_id'] ?? 0),
                'supplier'            => $supplier,
                'quantity'            => $this->toDecimal($row['quantity'] ?? 0),
                'price_excluding_tax' => $this->toNullableDecimal($row['price_excluding_tax'] ?? null),
                'total_price'         => $this->toNullableDecimal($row['total_price'] ?? null),
                'invoice_type'        => $this->normalizeInvoiceType($row['invoice_type'] ?? '1'),
                'tax_rate'            => $this->toNullableDecimal($row['tax_rate'] ?? null),
                'need_spectrum'       => (int)($row['need_spectrum'] ?? 0) ? 1 : 0,
                'remark'              => isset($row['remark']) ? trim((string)$row['remark']) : '',
            ];
        }

        if (empty($items)) {
            return [false, '请至少填写一行供应商报价', []];
        }

        return [true, '', $items];
    }

    private function saveItems(int $inquiryOrderId, array $items)
    {
        foreach ($items as $it) {
            ItemModel::create(array_merge($it, ['inquiry_order_id' => $inquiryOrderId]));
        }
    }

    private function toDecimal($v)
    {
        if ($v === null || $v === '') {
            return 0;
        }
        return round((float)$v, 4);
    }

    private function toNullableDecimal($v)
    {
        if ($v === null || $v === '') {
            return null;
        }
        return round((float)$v, 4);
    }

    private function normalizeInvoiceType($v)
    {
        $v = (string)$v;
        return ($v === '2') ? '2' : '1';
    }

    private function jsonProductByCatalog($catalog)
    {
        if ($catalog === '') {
            return json(['code' => 1, 'msg' => '请填写货号', 'data' => null]);
        }
        $row = ProductModel::where('catalog', $catalog)->field('name,ename,cas,catalog')->find();
        if (!$row) {
            return json(['code' => 1, 'msg' => '货号不存在', 'data' => null]);
        }
        return json([
            'code' => 0,
            'msg'  => 'ok',
            'data' => [
                'name'  => $row['name'],
                'ename' => $row['ename'],
                'cas'   => $row['cas'],
            ],
        ]);
    }
}
