<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/** @var array $arParams */
/** @var array $arResult */

$APPLICATION->SetTitle($arResult['TITLE']);
?>

<table class="crmgrid">
    <tr>
        <th>№</th>
        <th>Имя</th>
        <th>Ответственный</th>
        <th>Дата создания</th>
        <th>Статус</th>
        <th></th>
    </tr>
    <?php foreach($arResult['ENTITY'] as $key => $leads): ?>
    <tr>
        <td><?=++$key?></td>
        <td><b><?= $leads['TITLE']?></b></td>
        <td><?= $leads['ASSIGNED_BY_LAST_NAME']?> <?= $leads['ASSIGNED_BY_NAME']?></td>
        <td><?= date("d.m.Y", strtotime($leads['DATE_CREATE']))?></td>
        <td><?= $leads['STATUS']?></td>
        <td><a href="<?= $leads['DETAIL']?>"><?= GetMessage("DETAILS")?></a></td>
    </tr>
    <?php endforeach;?>
</table>