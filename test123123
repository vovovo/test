<?php 
CModule::IncludeModule("sale");
CModule::IncludeModule("iblock");
global $DB;

/*
 * 1) Представьте следующую структуру данных. В ИБ 20 хранятся товары. В ИБ 24 хранятся производители. В ИБ 20 есть свойство *
 * "PRODUCER", в котором к товару привязывается ID производителя из ИБ 24. Нужно посредством API-Битрикса запроса получить из ИБ 20 *
 * товары, которые были заведены за последние 7 дней, или у которых производитель называется Samsung минимально возможным количеством *
 * запросов к базе.
 */
$arSelect = Array("ID");
$arFilter = Array(
    "IBLOCK_ID"=>20,
        array("LOGIC"=>"OR",
            array("PROPERTY_PRODUCER.NAME"=>"Samsung"),
            array(">=DATE_CREATE"=>date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), mktime(0, 0, 0, date('m'), date('d') - 7, date('Y')))),
    )
);
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($item = $res->GetNext())
{
    print_r($item);
}

/*
 *
 * 2) Как одним запросом, с помощью API-Битрикса, получить список заказов за последнюю неделю, в которых хотя бы на один товар *
 * предоставлена скидка, и телефон покупателя начинается с цифры 7.
 *
 */
$arFilter = Array(
    ">BASKET_DISCOUNT_PRICE"=>0,
    "~PROPERTY_VAL_BY_CODE_PHONE"=>"7%",
    ">=DATE_INSERT" => date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), mktime(0, 0, 0, date('m'), date('d') - 7, date('Y')))
);
$dbRes = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter);
while ($order = $dbRes->Fetch()){
    print_r($order);
}

?>
