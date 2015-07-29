<?php
/**
 * @var yii\base\View $this
 * @var common\models\game $game
 * @var object $match
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = "Результат матчу";
?>

<div class='middle_team'>
    <? $form = ActiveForm::begin(); ?>
    <input id="hteam" type="hidden" name="homeTeam" value="<?=html::encode($match->homeTeam)?>">
    <input id="gteam" type="hidden" name="guestTeam" value="<?=html::encode($match->guestTeam)?>">
    <div class='regHeadTeam'>Визначення результату матча</div>
    <div class="rezulInfo">
        <div class="goals">
            <div class="hgoals">
                <div class="scores">
                    <div class='scoreTeamName'><?=html::encode($match->homeTeam)?></div>
                    <br>
                    <label>
                        <input class="hrowGoals" type="text" name="hgoals">
                    </label>
                </div>
            </div>
            <div class="midFunc">
                <p class="writeScore">Введіть рахунок</p>

                <div class="midFuncBtnGoal">Затвердити</div>
                <div class="midFuncBtnGoalRemove">Відміна</div>
            </div>
            <div class="ggoals">
                <div class="scores">
                    <div class='scoreTeamName'><?=html::encode($match->guestTeam)?></div>
                    <br>
                    <input class="growGoals" type="text" name="growGoals">
                </div>
            </div>
            <div class="clear"></div>
        </div>

        <div class="yellowCards">
            <div class="hyellows">
                <div class="scores">
                    <input class="hrowYellowCard" type="text" name="hrowyellows">
                </div>
            </div>
            <div class="midFunc">
                <p class="writeScore">Жовті картки</p>

                <div class="midFuncBtnYellow">Затвердити</div>
                <div class="midFuncBtnYellowRemove">Відміна</div>
            </div>
            <div class="gyellows">
                <div class="scores">
                    <input class="growYellowCard" type="text" name="growyellows">
                </div>
            </div>
            <div class="clear"></div>
        </div>


        <div class="redCards">
            <div class="hreds">
                <div class="scores">
                    <input class="hrowRedCard" name="hrowyellows">
                </div>
            </div>
            <div class="midFunc">
                <p class="writeScore">Червоні картки</p>

                <div class="midFuncBtnRed">Затвердити</div>
                <div class="midFuncBtnRedRemove">Відміна</div>
            </div>
            <div class="greds">
                <div class="scores">
                    <input class="growRedCard" name="growreds">
                </div>
            </div>
            <div class="clear"></div>
        </div>


    </div>
    <div class='add_button'><div class='reg_ok_button'><?= Html::submitButton('Завершити'); ?></div></div>
    <? ActiveForm::end(); ?>
</div>
