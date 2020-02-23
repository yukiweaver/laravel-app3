<?php

/**
 * エラー（JSON形式）で返す
 * @param array 
 */
function putjsonError($data)
{
  $array = [
    'status'  => 'ng',
    'content' => $data, 
  ];
  return json_encode($array);
}


/**
 * 成功（JSON形式）で返す
 * @param array 
 */
function putjsonSuccess($data)
{
  $array = [
    'status'  => 'ok',
    'content' => $data, 
  ];
  return json_encode($array);
}

function getArticleKbn($articleName)
{
  $array = [
    'domestic'      => '2',
    'world'         => '3',
    'business'      => '4',
    'entertainment' => '5',
    'sports'        => '6',
    'it'            => '7',
    'science'       => '8',
    'local'         => '9',
  ];
  return $array[$articleName];
}