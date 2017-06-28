<?php
/**
 * I have not used Model in this project, but
 * you can use them
 *
 * You can declare model in your controller with `use` command like:
 * use Micro\Model\AdminModel;
 */
namespace Micro\Model;

use Micro\Core\Model;

class AdminModel extends Model
{
    /**
     * Get all songs from database
     */
    public function getData()
    {
        $data = [1,2,3];
        return $data;
    }
}
