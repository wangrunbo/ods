<?php
use Migrations\AbstractMigration;

class AddIdNumAndAchievementAndEnAchievementFieldToApplicantsTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function up()
    {
        $applicants = $this->table('applicants');
        $applicants
            ->addColumn('id_num', 'string', ['limit' => 18, 'null' => true, 'comment' => '身份证号', 'after' => 'tel'])
            ->addColumn('achievement', 'float', ['precision' => 3, 'scale' => 1, 'null' => true, 'comment' => '高考成绩', 'after' => 'id_num'])
            ->addColumn('en_achievement', 'float', ['precision' => 3, 'scale' => 1, 'null' => true, 'comment' => '高考英语成绩', 'after' => 'achievement'])

            ->save();

        $this->execute("UPDATE applicants SET id_num='未输入' WHERE id_num IS NULL;");
        $this->execute("UPDATE applicants SET achievement=0 WHERE achievement IS NULL;");
        $this->execute("UPDATE applicants SET en_achievement=0 WHERE en_achievement IS NULL;");

        $applicants
            ->changeColumn('id_num', 'string', ['limit' => 18, 'null' => false, 'comment' => '身份证号'])
            ->changeColumn('achievement', 'float', ['precision' => 3, 'scale' => 1, 'null' => false, 'comment' => '高考成绩'])
            ->changeColumn('en_achievement', 'float', ['precision' => 3, 'scale' => 1, 'null' => false, 'comment' => '高考英语成绩'])

            ->save();
    }

    public function down()
    {
        $applicants = $this->table('applicants');
        $applicants
            ->removeColumn('id_num')
            ->removeColumn('achievement')
            ->removeColumn('en_achievement')

            ->save();
    }
}
