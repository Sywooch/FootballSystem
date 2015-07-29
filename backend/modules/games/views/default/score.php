<?php
/**
 * @var yii\web\View $this
 * @var array $match
 * @var array $homeTeamGoals
 * @var array $guestTeamGoals
 * @var array $homeTeamYCards
 * @var array $guestTeamYCards
 * @var array $homeTeamRCards
 * @var array $guestTeamRCards
 * @var object $model
 * @var string $title
 */
?>

    <div class='rezultField2'>
        <?if($match['0']['tour'] == 'Фінал')
          {
             echo "<div class='toure'>Результати фіналу кубка</div><br>";
             $model->title = "Результати фіналу кубка";
          }
        else
        {
            echo "<div class='toure'>Результати ".$match['0']['tour']." ".$title."</div><br>";
            $model->title = "Результати ".$match['0']['tour']." ".$title;
        }

        foreach($match as $value)
        {
            if($value['rezultato'] == '-')
            {
                echo $w = "<div class='emptyscore'>
        <div class='noscore'>$value[homeTeam] - $value[guestTeam] <span>/ перенесено</span></div></div>";
                $model->text.= $w;
           }
            else {

                echo $w = "<table class='score' onmousedown='return false'>
        <th class='scoreH'>".$value['homeTeam']."  ".count($homeTeamGoals[$value['homeTeam']]).":</th><th class='scoreG'>".count($guestTeamGoals[$value['guestTeam']])."  ".$value['guestTeam']."</th>
                <tbody class='info'>
                <tr>
                    <td><ul id='ball'>";
            $model->text.= $w;
                if(!empty($homeTeamGoals[$value['homeTeam']]))
                {
                    foreach($homeTeamGoals[$value['homeTeam']] as $value1)
                    {
                        echo $w = "<li>".$value1."</li>";
                        $model->text.= $w;
                    }
                }
                else
                {
                    echo $w = "<li> - </li>";
                    $model->text.= $w;
                }



                echo $w= "</ul></td><td><ul id='ball'>";
            $model->text.= $w;
                if(!empty($guestTeamGoals[$value['guestTeam']]))
                {
                    foreach($guestTeamGoals[$value['guestTeam']] as $gGvalue)
                    {
                        echo $w = "<li>".$gGvalue."</li>";
                        $model->text.= $w;
                    }
                }
                else
                {
                    echo $w = "<li> - </li>";
                    $model->text.= $w;
                }

                echo $w= "</ul></td></tr><tr><td><ul id='yellow_card'>";
            $model->text.= $w;
                if(!empty($homeTeamYCards[$value['homeTeam']]))
                {
                    foreach($homeTeamYCards[$value['homeTeam']] as $hYvalue)
                    {
                        echo $w = "<li>".$hYvalue."</li>";
                        $model->text.= $w;
                    }
                }
                else
                {
                    echo $w = "<li> - </li>";
                    $model->text.= $w;
                }

                echo $w= "</ul></td><td><ul id='yellow_card'>";
            $model->text.= $w;
                if(!empty($guestTeamYCards[$value['guestTeam']]))
                {
                    foreach($guestTeamYCards[$value['guestTeam']] as $gYvalue)
                    {
                        echo $w = "<li>".$gYvalue."</li>";
                        $model->text.= $w;
                    }
                }
                else
                {
                    echo $w = "<li> - </li>";
                    $model->text.= $w;
                }

                echo $w= "</ul></td></tr><tr><td><ul id='red_card'>";
            $model->text.= $w;
                if(!empty($homeTeamRCards[$value['homeTeam']]))
                {
                    foreach($homeTeamRCards[$value['homeTeam']] as $hRvalue)
                    {
                        echo $w = "<li>".$hRvalue."</li>";
                        $model->text.= $w;
                    }
                }
                else
                {
                    echo $w = "<li> - </li>";
                    $model->text.= $w;
                }

                echo $w= "</ul></td><td><ul id='red_card'>";
            $model->text.= $w;
                if(!empty($guestTeamRCards[$value['guestTeam']]))
                {
                    foreach($guestTeamRCards[$value['guestTeam']] as $gRvalue)
                    {
                        echo $w =  "<li>".$gRvalue."</li>";
                        $model->text.= $w;
                    }
                }
                else
                {
                    echo $w = "<li> - </li>";
                    $model->text.= $w;
                }

                echo $w= "</ul></td> </tr></tbody></table><div class='clear'></div>";
            $model->text.= $w;
        }}?>

    </div>
    <div class="clear"></div>

<?
//$model->text = strip_tags($model->text,'<p><h3><h4><h5><br><span><ul><li><div><table><td><tr><tbody><th>');
if($_GET['check'] == 1)
{
    $model->save();
}
?>