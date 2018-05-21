<?php
/**
 * @var \App\View\AppView $this
 * @var array $errors
 * @var array $default
 */
$this->setTitle('报名');
$this->setScriptVars('apply_complete_template', $this->element('apply_complete'), ['is_html' => true]);
$this->Html->script('Apply/index.js', ['block' => true]);
?>
<div>
    <h3 class="text-muted">法国留学桥说明会邀请函</h3>
</div>

<div class="jumbotron">
    <div>
        <?= $this->Html->image('fr-1.png', ['width' => '100%']) ?>
    </div>
    <h2></h2>
    <div class="panel panel-success">

        <div class="panel-body">
            <table class="table">
                <h3>课程设置</h3>
                <tbody align="left">
                <tr>
                    <td style="width:40%;"><strong><span style="font-size:16px;">半年预备课程</span></strong></td>
                    <td></td>
                </tr>
                <tr>
                    <td><p style="font-size:14px;">▷ 法国巴黎七大本科预备课程</p></td>
                    <td>招生对象：一本分数线以上，英语成绩优异，需通过我校英语笔试和口试</td>
                </tr>
                <tr>
                    <td><strong><span style="font-size:16px;">一年预备课程</span></strong></td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <p style="font-size:14px;">▷ 法国公立大学、高等商学院本科预备课程</p>
                        <p style="font-size:14px;">▷ 本科预备课程法国艺术院校本科预备课程</p>
                        <p style="font-size:14px;">▷ 法国工程师学校本科预备课程</p></td>
                    <td style="text-align:left;vertical-align:middle;">招生对象：有高考成绩，需通过我校英语笔试和面试</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="signin" class="container"><!-- 联系我们 -->
    <h3 class="form-signin-heading">预约说明会</h3>
    <div>
        <table class="table">

            <tbody>
            <tr>
                <td width="30%">报名地址</td>
                <td>上海交通大学长宁校区（长宁区法华镇路535号）主楼5楼523室</td>
            </tr>
            <tr>
                <td>咨询电话</td>
                <td>021-61530708 &nbsp 18621709317</td>
            </tr>
            <tr>
                <td>邮编</td>
                <td>200030</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="alert alert-success" role="alert">
        <?= $this->Form->create(null, ['id' => 'form-apply', 'class' => ['form-signin']]) ?>
            <label class="sr-only">姓名</label>
            <?= $this->Form->text('name', ['value' => $default['name'] ?? '', 'class' => ['form-control'], 'placeholder' => '姓名']) ?>
            <?php if (isset($errors['name'])): ?>
                <?= $this->element('validation', ['field' => 'name', 'error' => $errors['name']]) ?>
            <?php endif; ?>
            <br/>
            <label class="sr-only">联系电话</label>
            <?= $this->Form->text('tel', ['value' => $default['tel'] ?? '', 'class' => ['form-control'], 'placeholder' => '联系电话']) ?>
            <?php if (isset($errors['name'])): ?>
                <?= $this->element('validation', ['field' => 'tel', 'error' => $errors['tel']]) ?>
            <?php endif; ?>
            <br/>
            <button class="btn btn-lg btn-primary btn-block" type="submit">立即预约招生说明会</button>
        <?= $this->Form->end(); ?><!-- /联系我们 -->
    </div>
</div>

<div class="jumbotron">
    <h3>关于法国留学桥</h3>
    <p class="lead" style="text-align:left"><span style="text-align:left;font-size:14px;">
    上海交通大学继续教育学院留学桥——法国名校本科预备课程项目是上海交通大学审批，继续教育学院承办，专门为准备到法国攻读学士学位课程的学生量身定制的国际预备课程。
    校方与法国多所知名高校建立了紧密的合作关系，不仅给学生多元化的高校、专业选择，且所有入读该课程的学生满足条件后至少被一所优秀大学优先录取。</span></p>
    <p class="lead" style="text-align:left"><span style="text-align:left;font-size:14px;">
    课程拥有治学严谨的中外教师团队，并针对法国留学研发了一套教学体系，在语言学习的基础上，着重培养学生的文化、学术方法、面试技巧，根据学生的实际情况和校方的具体要求，全面提高学生综合素质。
    同时，专业的面试指导，帮助学生更轻松地通过使馆面签、更容易地融入法国新的学习生活。</span>
    </p>
</div>
<div>
    <img src="http://liuxue.sjtu.edu.cn/upload/201707/13/201707131744243597.jpg" width="100%">
    <div>
        <h3 align="center">办学优势</h3>
        <table class="table">
            <tbody>
            <tr>
                <td style="width:50%;">
                    ▷ 具品牌的国际本科、硕士直通车课程<br />
                </td>
                <td>
                    ▷ 国内先进的国际课程设置<br />
                </td>
            </tr>
            <tr>
                <td>
                    ▷ 完善的软硬件设施<br />
                </td>
                <td>
                    ▷ 个性化升学指导，名校优先录取<br />
                </td>
            </tr>
            <tr>
                <td>
                    ▷ 雄厚的师资力量，严谨的教学监控<br />
                </td>
                <td>
                    ▷ 国外预科直接见面<br />
                </td>
            </tr>
            <tr>
                <td>
                    ▷ 互动式小班授课，独树一帜的导师制度<br />
                </td>
                <td>
                    ▷ 雄厚的师资力量，严谨的教学监控<br />
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="page-header">
    <h3>校园风采</h3>
</div>
<div class="jumbotron">
    <div>
        <img src="http://liuxue.sjtu.edu.cn/upload/201712/22/201712220951248830.jpg" width="100%">
    </div>
    <h4>开学典礼</h4>
    <br/>

    <div>
        <img src="http://liuxue.sjtu.edu.cn/upload/201707/18/201707181148449976.jpg" width="100%">
    </div>
    <h4>留学桥全球留学展</h4>
    <br/>
    <div>
        <img src="http://liuxue.sjtu.edu.cn/upload/201711/10/201711101413590221.jpg" width="100%">
    </div>
    <h4>英语能力大赛</h4>
    <br/>

    <div>
        <img src="http://liuxue.sjtu.edu.cn/upload/201703/21/201703211504594664.jpg" width="100%">
    </div>
    <h4>校园篮球赛</h4>
    <br/>

    <div>
        <img src="http://liuxue.sjtu.edu.cn/upload/201707/18/201707181143509067.jpg" width="100%">
    </div>
    <h4>毕业典礼</h4>
</div>

