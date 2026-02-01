<?php

/** PHPExcel root directory */
if (!defined('PHPEXCEL_ROOT')) {
    /**
     * @ignore
     */
    define('PHPEXCEL_ROOT', dirname(__FILE__) . '/../../');
    require(PHPEXCEL_ROOT . 'PHPExcel/Autoloader.php');
}

/**
 * PHPExcel_Cell_DefaultValueBinder
 *
 * Copyright (c) 2006 - 2015 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel_Cell
 * @copyright  Copyright (c) 2006 - 2015 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
class PHPExcel_Cell_DefaultValueBinder implements PHPExcel_Cell_IValueBinder
{
    /**
     * Bind value to a cell
     *
     * @param  PHPExcel_Cell  $cell   Cell to bind value to
     * @param  mixed          $value  Value to bind in cell
     * @return boolean
     */
    public function bindValue(PHPExcel_Cell $cell, $value = null)
    {
        // sanitize UTF-8 strings
        if (is_string($value)) {
            $value = PHPExcel_Shared_String::SanitizeUTF8($value);
        } elseif (is_object($value)) {
            // Handle any objects that might be injected
            if ($value instanceof DateTime) {
                $value = $value->format('Y-m-d H:i:s');
            } elseif (!($value instanceof PHPExcel_RichText)) {
                $value = (string) $value;
            }
        }

        // Set value explicit
        $cell->setValueExplicit($value, self::dataTypeForValue($value));

        // Done!
        return true;
    }

    /**
     * DataType for value
     *
     * @param   mixed  $pValue
     * @return  string
     */
    public static function dataTypeForValue($pValue = null)
    {
        // 1. 处理 null 和空字符串
        if ($pValue === null) {
            return PHPExcel_Cell_DataType::TYPE_NULL;
        }

        if ($pValue === '') {
            return PHPExcel_Cell_DataType::TYPE_STRING;
        }

        // 2. 处理对象类型
        if ($pValue instanceof PHPExcel_RichText) {
            return PHPExcel_Cell_DataType::TYPE_INLINE;
        }

        // 3. 处理布尔值
        if (is_bool($pValue)) {
            return PHPExcel_Cell_DataType::TYPE_BOOL;
        }

        // 4. 处理数值类型（整数和浮点数）
        if (is_int($pValue) || is_float($pValue)) {
            return PHPExcel_Cell_DataType::TYPE_NUMERIC;
        }

        // 5. 处理字符串类型
        if (is_string($pValue)) {
            // 5.1 检查是否是公式（以=开头）
            if (strlen($pValue) > 1 && $pValue[0] === '=') {
                return PHPExcel_Cell_DataType::TYPE_FORMULA;
            }

            // 5.2 检查是否是错误码
            if (array_key_exists($pValue, PHPExcel_Cell_DataType::getErrorCodes())) {
                return PHPExcel_Cell_DataType::TYPE_ERROR;
            }

            // 5.3 检查是否是数值字符串
            if (self::isNumericString($pValue)) {
                return PHPExcel_Cell_DataType::TYPE_NUMERIC;
            }

            // 5.4 其他字符串
            return PHPExcel_Cell_DataType::TYPE_STRING;
        }

        // 6. 默认返回字符串类型
        return PHPExcel_Cell_DataType::TYPE_STRING;
    }

    /**
     * 检查字符串是否为数值格式
     * 修复了原代码中的类型访问问题
     */
    private static function isNumericString($value)
    {
        // 使用更精确的正则表达式匹配数值
        $numericPattern = '/^[\+\-]?(\d+\.?\d*|\.\d+)([eE][\+\-]?\d+)?$/';

        if (!preg_match($numericPattern, $value)) {
            return false;
        }

        $trimmedValue = ltrim($value, '+-');

        // 检查前导零（如 0123 应该被视为字符串）
        if (strlen($trimmedValue) > 1 && $trimmedValue[0] === '0' && $trimmedValue[1] !== '.') {
            return false;
        }

        // 检查是否超过 PHP 整数最大值
        if (strpos($value, '.') === false && $value > PHP_INT_MAX) {
            return false;
        }

        return true;
    }
}
