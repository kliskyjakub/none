<?php

use yii\db\Migration;

/**
 * Class m180701_190050_Sixers_Knicks
 */
class m180701_190050_Sixers_Knicks extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('box_score',
            [
                'name' => $this->string()->notNull()->unique(),
                'position' => $this->string()->notNull(),
                'kit_number' => $this->integer()->notNull(),
                'team' => $this->string()->notNull(),
                'started' => $this->boolean()->notNull(),
                'played' => $this->boolean()->notNull(),
                'minutes' => $this->integer(),
                'points' => $this->integer(),
                'rebounds' => $this->integer(),
                'assists' => $this->integer(),
                'steals' => $this->integer(),
                'blocks' => $this->integer(),
                'turnovers' => $this->integer(),
                'fouls' => $this->integer(),
                'dunks' => $this->integer()
            ]);
        $this->batchInsert('box_score',[
            'name','position','kit_number','team','started','played','minutes','points','rebounds','assists','steals','blocks','turnovers','fouls','dunks'
        ],
            [
                //Philly players
                ['Ben Simmons','PF',25,'Philadelphia 76ers',true,true,34,51,12,5,2,1,2,1,16],
                ['Kelly Oubre Jr.','SF',12,'Philadelphia 76ers',false,true,22,20,5,3,1,2,1,1,0],
                ['Boyd O\'Keady','SG',14,'Philadelphia 76ers',true,true,26,19,1,4,3,0,2,1,0],
                ['Paul George','SF',40,'Philadelphia 76ers',true,true,26,15,7,6,3,1,3,1,1],
                ['Joel Embiid','C',21,'Philadelphia 76ers',true,true,26,15,17,5,1,3,1,2,2],
                ['Willy Hernangomez','C',41,'Philadelphia 76ers',false,true,23,8,11,0,0,3,1,4,1],
                ['T.J. McConnell','PG',5,'Philadelphia 76ers',false,true,15,6,1,4,3,0,0,0,0],
                ['Tomáš Satoranský','PG',31,'Philadelphia 76ers',false,true,15,5,1,5,2,0,0,0,0],
                ['Markelle Fultz','PG',20,'Philadelphia 76ers',true,true,23,4,1,11,3,0,2,4,1],
                ['Timothe Luwawu-Cabarrot','SG',7,'Philadelphia 76ers',false,true,11,2,1,1,1,0,1,0,1],
                ['Furkan Korkmaz','SF',9,'Philadelphia 76ers',false,true,10,2,2,0,1,0,0,0,0],
                ['Justin Anderson','SF',1,'Philadelphia 76ers',false,true,15,0,1,0,1,0,1,1,0],
                ['Robert Covington','SF',33,'Philadelphia 76ers',false,false,null,null,null,null,null,null,null,null,null],

                //NY players
                ['Tim Hardaway Jr.','SG',3,'New York Knicks',true,true,27,17,1,2,1,0,2,1,1],
                ['Jahlil Okafor','C',4,'New York Knicks',true,true,27,13,6,1,1,0,0,3,0],
                ['Tony Parker','PG',9,'New York Knicks',false,true,14,10,1,1,1,0,2,0,0],
                ['Timofey Mozgov','C',20,'New York Knicks',false,true,19,10,10,0,1,0,0,1,1],
                ['Frank Ntilikina','C',21,'New York Knicks',true,true,26,9,1,5,1,0,5,2,0],
                ['Ron Baker','PG',31,'New York Knicks',false,true,19,9,3,2,0,0,3,1,0],
                ['Kevin Horton','C',5,'New York Knicks',false,true,10,6,7,0,0,0,0,0,0],
                ['Jalen Jones','SF',18,'New York Knicks',true,true,26,5,4,2,4,0,3,2,0],
                ['Emmanuel Mudiay','PG',1,'New York Knicks',false,true,17,5,1,2,0,0,4,2,0],
                ['Andre Roberson','SF',21,'New York Knicks',false,true,16,3,0,2,0,0,1,0,0],
                ['Noah Vonleh','PF',30,'New York Knicks',true,true,25,2,4,0,3,0,2,1,0],
                ['Lance Thomas','SF',42,'New York Knicks',false,true,10,2,3,0,0,0,0,1,0],
                ['Dorian Finney-Smith','SF',8,'New York Knicks',true,true,10,0,1,2,0,0,0,0,0],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('box_score');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180701_190050_Sixers_Knicks cannot be reverted.\n";

        return false;
    }
    */
}
