-- 已有库升级：询价单主从表拆分（执行前请备份）
-- 若已执行过请勿重复执行

-- 1) 子表（无外键，便于先迁数据）
CREATE TABLE IF NOT EXISTS hisi_system_inquiry_order_item
(
    id                  INT AUTO_INCREMENT PRIMARY KEY COMMENT '询价报价行ID',
    inquiry_order_id    INT UNSIGNED NOT NULL COMMENT '询价单ID',
    sort_order          TINYINT UNSIGNED NOT NULL DEFAULT 1 COMMENT '排序1-10',
    supplier_id         INT(10) NOT NULL DEFAULT 0 COMMENT '供应商ID',
    supplier            VARCHAR(255) NOT NULL DEFAULT '' COMMENT '供应商名称',
    quantity            DECIMAL(12, 4) NOT NULL DEFAULT 0 COMMENT '数量',
    price_excluding_tax DECIMAL(12, 4) DEFAULT NULL COMMENT '不含税价',
    total_price         DECIMAL(12, 4) DEFAULT NULL COMMENT '总价',
    invoice_type        VARCHAR(50) DEFAULT NULL COMMENT '发票类型',
    tax_rate            DECIMAL(5, 2) DEFAULT NULL COMMENT '税率（百分比）',
    need_spectrum       TINYINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否提供谱图：0-否，1-是',
    remark              TEXT COMMENT '备注',
    ctime               INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
    mtime               INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '修改时间',
    INDEX idx_inquiry_order_id (inquiry_order_id)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COMMENT ='询价单供应商报价明细';

-- 2) 主表增加 product_name（若列已存在会报错，请跳过本步）
ALTER TABLE hisi_system_inquiry_order
    ADD COLUMN product_name VARCHAR(255) NOT NULL DEFAULT '' COMMENT '商品名称(冗余自产品表)' AFTER cas;

-- 3) 从商品表回填品名
UPDATE hisi_system_inquiry_order o
    LEFT JOIN hisi_system_product p ON p.catalog = o.catalog
SET o.product_name = IFNULL(NULLIF(TRIM(p.name), ''), o.catalog)
WHERE o.product_name = '' OR o.product_name IS NULL;

-- 4) 旧数据迁入子表（仅当子表尚无对应询价单数据时执行，可重复前先 TRUNCATE 子表）
INSERT INTO hisi_system_inquiry_order_item (
    inquiry_order_id, sort_order, supplier_id, supplier, quantity,
    price_excluding_tax, total_price, invoice_type, tax_rate, need_spectrum, remark, ctime, mtime
)
SELECT
    o.id,
    1,
    IFNULL(o.supplier_id, 0),
    IFNULL(o.supplier, ''),
    IFNULL(o.quantity, 0),
    o.price_excluding_tax,
    o.total_price,
    o.invoice_type,
    o.tax_rate,
    IFNULL(o.need_spectrum, 0),
    o.remark,
    IFNULL(o.ctime, 0),
    IFNULL(o.mtime, 0)
FROM hisi_system_inquiry_order o
WHERE NOT EXISTS (
    SELECT 1 FROM hisi_system_inquiry_order_item i WHERE i.inquiry_order_id = o.id
);

-- 5) 主表删除已迁移到子表的列
ALTER TABLE hisi_system_inquiry_order
    DROP COLUMN quantity,
    DROP COLUMN price_excluding_tax,
    DROP COLUMN total_price,
    DROP COLUMN invoice_type,
    DROP COLUMN tax_rate,
    DROP COLUMN supplier_id,
    DROP COLUMN supplier,
    DROP COLUMN need_spectrum,
    DROP COLUMN remark;

-- 6) 外键（若已存在会报错，请跳过）
ALTER TABLE hisi_system_inquiry_order_item
    ADD CONSTRAINT fk_inquiry_item_order
        FOREIGN KEY (inquiry_order_id) REFERENCES hisi_system_inquiry_order (id) ON DELETE CASCADE;
