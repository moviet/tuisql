<?php
/**
 * Tuisql - A dynamic php database builder
 *
 * @category   Database Fetchs
 * @package    Rammy Labs
 *
 * @author     Moviet
 * @license    MIT Public License
 */
namespace Moviet\Base\Fetchs;

use \PDO;

class Rtui
{
    /**
     * Generate data with one row
     * 
     * @param object $data
     * @return object
     */
    public static function oneRow($data)
    {
        return $data->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Generate data with one column
     * 
     * @param object $data
     * @return object
     */
    public static function oneColumn($data)
    {
        return $data->fetchColumn(PDO::FETCH_COLUMN);
    }

    /**
     * Generate data with count
     * 
     * @param object $data
     * @return object
     */
    public static function count($data)
    {
        return $data->rowCount(PDO::FETCH_ASSOC);
    }

    /**
     * Generate data with num row
     * 
     * @param object $data
     * @return object
     */
    public static function oneNum($data)
    {
        return $data->fetch(PDO::FETCH_NUM);
    }

    /**
     * Generate data with lazy row
     * 
     * @param object $data
     * @return object
     */
    public static function oneLazy($data)
    {
        return $data->fetch(PDO::FETCH_LAZY);
    }

    /**
     * Generate data with row object
     * 
     * @param object $data
     * @return object
     */
    public static function allObj($data)
    {
        return $data->fetchAll(PDO::FETCH_OBJ);
    }
    
    /**
     * Generate data with all rows
     * 
     * @param object $data
     * @return object
     */
    public static function allRow($data)
    {
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function notFound($query, $url)
    {
        $host = $_SERVER['HTTP_HOST'] .'/'. $url;

        if (!$query) {
            header("location: {$host}");
            exit();
        }

        return $query;
    }
}