<?php

namespace Micro\Core;

class GridView {

    //Default table properties (Can be overwritten when calling Show function with "options" param.)
    public static $table_options_default = [
        'id' => '',
        'class' => 'table table-hover table-striped display dataTable dtr-inline',
    ];

    /**
     * Populate grid view
     * @param object $dataSource Data source (currently using notOrm object format)
     * @param array $table_options 'table' tag properties like id,class etc.
     * @param array $columns Columns to be populated from data source with
     *                      label = Column Head
     *                      value = data field
     *                                  OR
     *                             anonymous function data row will be passed as 1st function parameter
     */
    public static function show($dataSource, $table_options, $columns) {

        //Extract label Heads and value fields array from $columns
        $table_heads = self::extElements($columns, 'label');
        $value_fileds = self::extElements($columns, 'value');

        ?>
        <table <?= self::setOptions($table_options, self::$table_options_default) ?>>
            <thead>
                <?php foreach ($table_heads as $key => $value): ?>
                <th><?= $value ?></th>
                <?php endforeach; ?>
            </thead>

            <tfoot>
                <?php foreach ($table_heads as $key => $value): ?>
                    <th><?= $value ?></th>
                <?php endforeach; ?>
            </tfoot>

        <tbody>
            <?php foreach ($dataSource as $row): ?>
                <tr>
                    <?php $row = fetch_row($row); ?>
                    <?php foreach ($value_fileds as $cell_value): ?>
                        <td>
                            <?= (!is_string($cell_value))? $cell_value($row) : $row->$cell_value; ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
        </table>

        <?php


    }

    /**
     * Convert options from array to string
     * @param array $array_options   User passed options as array
     * @param array $default_options Default array of options to be used
     * @return string options
     */
    public static function setOptions($array_options, $default_options = null) {

        if(!is_array($default_options) || !is_array($array_options))
            return '';

        $opts = array_merge($default_options, $array_options);

        $strOpts = '';
        foreach ($opts as $key => $value) {
            $strOpts .= ' ' . $key . '="' . $value . '"';
        }

        return $strOpts;
    }

    /**
     * Extract array elements from column multidimensional array
     * @param array $columns columns array
     * @param string $filedToExtract element to be extracted from array
     * @return array
     */
    public static function extElements($columns, $filedToExtract) {

        if(!is_array($columns))
            return false;

        $extracted = [];

        foreach ($columns as $key => $value) {
            foreach ($value as $k => $v) {
                if ($k == $filedToExtract)
                    $extracted[] = $v;
            }
        }

        return $extracted;
    }

}
