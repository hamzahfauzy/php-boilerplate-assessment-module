<?php
$role = get_role(auth()->id);
$having = "";

$filter_query = [];
if($role->role_id != 1)
{
    $filter_query[] = "(assessor_id = ".auth()->id." OR user_id = ".auth()->id.")";
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

$where = $where ." ". $having;
$baseQuery = "SELECT * FROM $this->table $where ORDER BY ".$col_order." ".$order[0]['dir'];
$db->query = $baseQuery." LIMIT $start,$length";

$data  = $this->db->exec('all');

$this->db->query = $baseQuery;
$total = $this->db->exec('exists');

return compact('data','total');