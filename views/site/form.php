<?php

/** @var yii\web\View $this */

/** @var Country[] $countries */

use yii\helpers\Html;
use app\models\Country;

$this->title = 'Form';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <form action="">

        <div class="form-group">
            <label for="country">Country</label>
            <select class="form-control" id="country">
                <option></option>
                <?php foreach ($countries as $country): ?>
                    <option value="<?php echo $country->id; ?>"><?php echo $country->name; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="state">State</label>
            <select class="form-control" id="state">
            </select>
        </div>

        <div class="form-group">
            <label for="city">City</label>
            <select class="form-control" id="city">
            </select>
        </div>

    </form>

</div>
<script>
    window.addEventListener('DOMContentLoaded', () => {
        $("#country").on('change', () => {
            $.get('/site/get-states', {country_id: $("#country").val()}, (data) => {
                $('#state').find('option').remove();
                $('#city').find('option').remove();
                $("#state").append(new Option());

                $.each(data, (i, item) => {
                    $("#state").append(new Option(item.name, item.id));
                });
            });
        });

        $("#state").on('change', () => {
            $.get('/site/get-cities', {state_id: $("#state").val()}, (data) => {
                $('#city').find('option').remove();
                $("#city").append(new Option());

                $.each(data, (i, item) => {
                    $("#city").append(new Option(item.name, item.id));
                });
            });
        });
    });
</script>
