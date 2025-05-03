<style type="text/css">
li {
    padding-bottom: 5mm;
}
</style>
<div style="margin-left:30;margin-right:30;margin-top:30;">
<?php if($kop): ?>
<img src="<?=$kop?>" alt="" width="735">
<?php endif ?>

<table>
    <tr>
        <td width="700">
            <?= $peserta->template_text ?>
        </td>
    </tr>
</table>
</div>