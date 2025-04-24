<?php

use Illuminate\Support\Facades\DB;

function all($table, $select = [], $where = null, $value = null)
{
    return DB::table($table)->select($select)->where($where, $value)->get();
}



// function row($table, $select = [], $where = null, $value = null)
// {
//     return DB::table($table)->select($select)->where($where, $value)->first();
// }


// function countColumns($table, $select = [], $where = null, $value = null)
// {
//     return DB::table($table)->select($select)->where($where, $value)->count();
// }



if (!function_exists('fetchRow')) {

    function fetchRow(string $table, array $query = [])
    {

        $select = isset($query['select']) ? $query['select'] : ['*']; // Select 
        $where  = isset($query['where']) ? $query['where'] : null; // Select 


        // Stetment Section 1
        $stetment = DB::table($table)->select($select);
        // Check IF $where not null
        if ($where !== null) {
            // Check IF $where is not array
            if (!is_array($where)) {
                // Return Error
                return  abort(301, 'Error function ' . __FUNCTION__ . '() : ' . "where clause must be an associative array");
            } else {
                // Check If $where is associative array if stetment not equla true skip error 
                if (array_keys($where) === range(0, count($where) - 1)) {
                    // Return Error
                    return abort(301, 'Error function ' . __FUNCTION__ . '() : ' . "where clause value must be an array ['key' => 'value']");
                }
            }

            // Stetment Section 2
            $stetment->where($where);
        }


        return $stetment->first();
    }
}


function fetchRows($table, $select = [], $where = null, $value = null)
{
    return DB::table($table)->select($select)->where($where, $value)->get();
}




function footerGetSubCategories()
{
    return DB::table('sub_categories')->select(['name', 'slug'])->orderByDesc('id')->limit(5)->get();
}
