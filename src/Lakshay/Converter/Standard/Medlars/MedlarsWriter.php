<?php

namespace Lakshay\Converter\Standard\Medlars;

use LibRIS\RISReader;

/**
 * Class for writing Medlars data.
 *
 * General usage:
 * @code
 * <?php
 * use Lakshay\Converter\Standard\EndNote\MedlarsWriter;
 *
 * $writer = new MedlarsWriter();
 *
 * // Write an associative array of records to a string.
 * $str = $writer->writeRecords($records);
 * ?>
 * @endcode
 *
 * @author Lakshay Verma <verma_lakshay@live.in>
 */
class MedlarsWriter
{

    public function __construct()
    {
    }

    /**
     * Write a series of records to a single RIS string.
     *
     * @param array $records
     *  An array in the format generated by RISReader::parseFile()
     * @retval string
     *  The record as a string.
     */
    public function writeRecords($records)
    {
        $buffer = array();
        foreach ($records as $record) {
            $buffer[] = $this->writeRecord($record);
        }
        return implode(RISReader::RIS_EOL, $buffer);
    }

    /**
     * Write a single record as an RIS string.
     *
     * The record should be an associative array of tags to values.
     *
     * @param array $tags
     *  An associative array of key => array(value1, value2,...).
     * @retval string
     *  The record as a string.
     */
    public function writeRecord($tags)
    {
        $buffer = array();
        $fmt = '%s %s';

        foreach ($tags as $tag => $values) {
            foreach ($values as $value) {
                if (is_array($value)) {
                    $buffer[] = sprintf($fmt, $tag, implode(' ', $value));
                } else {
                    $buffer[] = sprintf($fmt, $tag, $value);
                }
            }
        }

        return implode(RISReader::RIS_EOL, $buffer);
    }
}
