<?php
header('Content-Type: application/json');
if (array_key_exists('HTTP_EVE_CHARID', $_SERVER)) {
  $trusted = true;
} else {
  // die("Access from IGB with Trusted header set");
  $trusted = false;
}

// set parameters from defaults
$type = (array_key_exists('type', $_GET) ? $_GET['type'] : 'med');
$figure = (array_key_exists('figure', $_GET) ? $_GET['figure'] : 'all');
$modifier = (array_key_exists('efficiency', $_GET) ? $_GET['efficiency'] : 1.0);

$ores = array(
  'Veldspar' => array(
    'vol'  => 0.1,
    'sec'  => 1.0,
    'batch'=> 333,
    'comp' => array(
      34 => 1000,
      35 => 0,
      36 => 0,
      37 => 0,
      38 => 0,
      39 => 0,
      40 => 0,
      11399 => 0,
    ),
  ),
  'Scordite' => array(
    'vol'  => 0.15,
    'sec'  => 1.0,
    'batch'=> 333,
    'comp' => array(
      34 => 833,
      35 => 416,
      36 => 0,
      37 => 0,
      38 => 0,
      39 => 0,
      40 => 0,
      11399 => 0,
    ),
  ),
  'Pyroxeres' => array(
    'vol'  => 0.3,
    'sec'  => 0.9,
    'batch'=> 333,
    'comp' => array(
      34 => 844,
      35 => 59,
      36 => 120,
      37 => 0,
      38 => 11,
      39 => 0,
      40 => 0,
      11399 => 0,
    ),
  ),
  'Kernite' => array(
    'vol'  => 1.2,
    'sec'  => 0.4,
    'batch'=> 400,
    'comp' => array(
      34 => 386,
      35 => 0,
      36 => 773,
      37 => 386,
      38 => 0,
      39 => 0,
      40 => 0,
      11399 => 0,
    ),
  ),
  'Plagioclase' => array(
    'vol'  => 0.35,
    'sec'  => 0.9,
    'batch'=> 333,
    'comp' => array(
      34 => 256,
      35 => 512,
      36 => 256,
      37 => 0,
      38 => 0,
      39 => 0,
      40 => 0,
      11399 => 0,
    ),
  ),
  'Omber' => array(
    'vol'  => 0.6,
    'sec'  => 0.7,
    'batch'=> 500,
    'comp' => array(
      34 => 307,
      35 => 123,
      36 => 0,
      37 => 307,
      38 => 0,
      39 => 0,
      40 => 0,
      11399 => 0,
    ),
  ),
  'Jaspet' => array(
    'vol'  => 2,
    'sec'  => 0.4,
    'batch'=> 400,
    'comp' => array(
      34 => 259,
      35 => 259,
      36 => 518,
      37 => 0,
      38 => 259,
      39 => 8,
      40 => 0,
      11399 => 0,
    ),
  ),
  'Hemorphite' => array(
    'vol'  => 3,
    'sec'  => 0.2,
    'batch'=> 500,
    'comp' => array(
      34 => 212,
      35 => 0,
      36 => 0,
      37 => 212,
      38 => 424,
      39 => 28,
      40 => 0,
      11399 => 0,
    ),
  ),
  'Hedbergite' => array(
    'vol'  => 3,
    'sec'  => 0.2,
    'batch'=> 500,
    'comp' => array(
      34 => 0,
      35 => 0,
      36 => 0,
      37 => 708,
      38 => 354,
      39 => 32,
      40 => 0,
      11399 => 0,
    ),
  ),
  'Gneiss' => array(
    'vol'  => 5,
    'sec'  => 0.0,
    'batch'=> 400,
    'comp' => array(
      34 => 171,
      35 => 0,
      36 => 171,
      37 => 343,
      38 => 0,
      39 => 171,
      40 => 0,
      11399 => 0,
    ),
  ),
  'Dark Ochre' => array(
    'vol'  => 8,
    'sec'  => 0.0,
    'batch'=> 400,
    'comp' => array(
      34 => 250,
      35 => 0,
      36 => 0,
      37 => 0,
      38 => 500,
      39 => 250,
      40 => 0,
      11399 => 0,
    ),
  ),
  'Crokite' => array(
    'vol'  => 16,
    'sec'  => 0.0,
    'batch'=> 250,
    'comp' => array(
      34 => 331,
      35 => 0,
      36 => 0,
      37 => 0,
      38 => 331,
      39 => 663,
      40 => 0,
      11399 => 0,
    ),
  ),
  'Spodumain' => array(
    'vol'  => 16,
    'sec'  => 0.0,
    'batch'=> 250,
    'comp' => array(
      34 => 700,
      35 => 140,
      36 => 0,
      37 => 0,
      38 => 0,
      39 => 0,
      40 => 140,
      11399 => 0,
    ),
  ),
  'Bistot' => array(
    'vol'  => 16,
    'sec'  => 0.0,
    'batch'=> 200,
    'comp' => array(
      34 => 0,
      35 => 170,
      36 => 0,
      37 => 0,
      38 => 0,
      39 => 341,
      40 => 170,
      11399 => 0,
    ),
  ),
  'Arkanor' => array(
    'vol'  => 16,
    'sec'  => 0.0,
    'batch'=> 200,
    'comp' => array(
      34 => 300,
      35 => 0,
      36 => 0,
      37 => 0,
      38 => 0,
      39 => 166,
      40 => 333,
      11399 => 0,
    ),
  ),
  'Mercoxit' => array(
    'vol'  => 40,
    'sec'  => 0.0,
    'batch'=> 250,
    'comp' => array(
      34 => 250,
      35 => 0,
      36 => 0,
      37 => 0,
      38 => 0,
      39 => 0,
      40 => 0,
      11399 => 530,
    ),
  ),
);

$regions = array(
  'Placid'       => 10000048,
  'Essence'      => 10000064,
  'Syndicate'    => 10000041,
);

function xmlObjToArr($obj) {
  $namespace = $obj->getDocNamespaces(true);
  $namespace[NULL] = NULL;
 
  $children = array();
  $attributes = array();
  $name = strtolower((string)$obj->getName());
 
  $text = trim((string)$obj);
  if( strlen($text) <= 0 ) {
    $text = NULL;
  }
 
  // get info for all namespaces
  if(is_object($obj)) {
    foreach( $namespace as $ns=>$nsUrl ) {
      // atributes
      $objAttributes = $obj->attributes($ns, true);
      foreach( $objAttributes as $attributeName => $attributeValue ) {
        $attribName = strtolower(trim((string)$attributeName));
        $attribVal = trim((string)$attributeValue);
        if (!empty($ns)) {
            $attribName = $ns . ':' . $attribName;
        }
        $attributes[$attribName] = $attribVal;
      }
     
      // children
      $objChildren = $obj->children($ns, true);
      foreach( $objChildren as $childName=>$foal ) {
        $childName = strtolower((string)$childName);
        if( !empty($ns) ) {
            $childName = $ns.':'.$childName;
        }
        $children[$childName][] = xmlObjToArr($foal);
      }
    }
  }
 
  return array(
      'name'=>$name,
      'text'=>$text,
      'attributes'=>$attributes,
      'children'=>$children
  );
}

function getPriceXML($reg) {
  $path = 'http://api.eve-central.com/api/marketstat';
  $arguments = '?typeid=34&typeid=35&typeid=36&typeid=37&typeid=38&typeid=39&typeid=40&typeid=11399';
  $arguments .= '&regionlimit='.$reg;
  $xml = file_get_contents($path.$arguments);
  return $xml;
}

function messToArray($mess, $att) {
  $array = array(
    'buy' => $mess['children']['buy'][0]['children'][$att][0]['text'],
    'sell' => $mess['children']['sell'][0]['children'][$att][0]['text'],
    'all' => $mess['children']['all'][0]['children'][$att][0]['text'],
  );
  return $array;
}

function getMineralValues($reg) {
  $xml = getPriceXML($reg);
  $data = xmlObjToArr(new SimpleXMLElement($xml));
  $data = $data['children']['marketstat'][0]['children']['type'];
  $ore = array();
  foreach ($data as $result => $info) {
    $ore[$info['attributes']['id']] = array(
      'vol' => messToArray($info, 'volume'),
      'avg' => messToArray($info, 'avg'),
      'min' => messToArray($info, 'min'),
      'max' => messToArray($info, 'max'),
      'med' => messToArray($info, 'median'),
      'std' => messToArray($info, 'stddev'),
      'per' => messToArray($info, 'percentile'),
    );
  }
  return $ore;
}
function getOreValues($reg, $type, $figure) {
  $prices = getMineralValues($reg);
  $data = array();
  foreach ($prices as $id => $stats) {
    $data[$id] = $stats[$type][$figure];
  }
  return $data;
}

function price($region, $type, $figure, $modifier, $ores, $regions) {
  $prices = getOreValues($region, $type, $figure);

  // value isk per cubic meter
  $value = array();
  foreach($ores as $type => $info) {
    $value_batch = 0;
    foreach($info['comp'] as $id => $amount) {
      $value_batch += $prices[$id] * $amount * $modifier;
    }
    $val_per_isk = $value_batch / ($info['batch'] * $info['vol']);
    $value[$type] = round($val_per_isk, 3);
  }
  return $value;
}
$regional_prices = array();
foreach($regions as $name => $id) {
  $regional_prices[$name] = price($id, $type, $figure, $modifier, $ores, $regions);
}
foreach ($regional_prices as $loc => $prices) {
  arsort($regional_prices[$loc]);
}

$price_by_ore = array();
foreach ($ores as $name => $data) {
  $price_by_ore[$name] = null;
}
foreach ($regional_prices as $region => $prices) {
  foreach ($prices as $ore => $price) {
    $price_by_ore[$ore][$region] = $price;
  }
}

foreach ($price_by_ore as $ore => $array) {
  arsort($price_by_ore[$ore]);
}

$package = array(
  'params' => array(
    'api' => 'ore-1.1.1',
    'generated' => time(),
    'type' => $type,
    'figure' => $figure,
    'efficiency' => $modifier,
  ),
  'priceByOre' => $price_by_ore,
  'priceByRegion' => $regional_prices,
);
echo json_encode($package);
?>
