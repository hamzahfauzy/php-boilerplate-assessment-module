<?php

$roles = get_roles(auth()->id);
$roleIds = [];
foreach($roles as $role)
{
    $roleIds[] = $role->role_id;
}
$having = "";

$filter_query = [];
if(!in_array(1, $roleIds) && !in_array(env('EVALUATOR_ROLE_ID'), $roleIds))
{
    $filter_query[] = 'user_id = '.auth()->id;
}

if($filter || count($filter_query))
{
    foreach($filter as $f_key => $f_value)
    {
        $filter_query[] = "$f_key = '$f_value'";
    }

    $filter_query = implode(' AND ', $filter_query);

    $having = (empty($having) ? 'HAVING ' : ' AND ') . $filter_query;
}

$col_order = $col_order == 'id' ? $this->table.'.work_date' : $col_order;
$order[0]['dir'] = $col_order == $this->table.'.work_date' ? 'DESC' : $order[0]['dir'];

$where = $where ." ". $having;
$baseQuery = "SELECT 
    $this->table.*, 
    emp.name employee,
    evl.name evaluator,
    media.name `file` 
    FROM $this->table 
    LEFT JOIN users AS emp ON emp.id = $this->table.user_id
    LEFT JOIN users AS evl ON evl.id = $this->table.evaluator_id
    LEFT JOIN media ON media.id = $this->table.media_id 
    $where 
    ORDER BY ".$col_order." ".$order[0]['dir'];
$db->query = $baseQuery." LIMIT $start,$length";

$data  = $this->db->exec('all');

$this->db->query = $baseQuery;
$total = $this->db->exec('exists');

return compact('data','total');