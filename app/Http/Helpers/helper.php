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