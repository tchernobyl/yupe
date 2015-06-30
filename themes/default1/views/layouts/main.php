<!DOCTYPE html>
<html lang="<?php echo Yii::app()->language; ?>">
<head>

    <?php Yii::app()->controller->widget(
        'vendor.chemezov.yii-seo.widgets.SeoHead',
        array(
            'httpEquivs'         => array(
                'Content-Type'     => 'text/html; charset=utf-8',
                'X-UA-Compatible'  => 'IE=edge,chrome=1',
                'Content-Language' => 'ru-RU'
            ),
            'defaultTitle'       => Yii::app()->getModule('yupe')->siteName,
            'defaultDescription' => Yii::app()->getModule('yupe')->siteDescription,
            'defaultKeywords'    => Yii::app()->getModule('yupe')->siteKeyWords,
        )
    ); ?>

    <?php
    $mainAssets = Yii::app()->getTheme()->getAssetsUrl();

    Yii::app()->getClientScript()->registerCssFile($mainAssets . '/css/main.css');
    Yii::app()->getClientScript()->registerCssFile($mainAssets . '/css/flags.css');
    Yii::app()->getClientScript()->registerCssFile($mainAssets . '/css/yupe.css');
    Yii::app()->getClientScript()->registerScriptFile($mainAssets . '/js/blog.js');
    Yii::app()->getClientScript()->registerScriptFile($mainAssets . '/js/bootstrap-notify.js');
    Yii::app()->getClientScript()->registerScriptFile($mainAssets . '/js/jquery.li-translit.js');
    ?>
    <script type="text/javascript">
        var yupeTokenName = '<?php echo Yii::app()->getRequest()->csrfTokenName;?>';
        var yupeToken = '<?php echo Yii::app()->getRequest()->csrfToken;?>';
    </script>
    <!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="http://yandex.st/highlightjs/8.2/styles/github.min.css">
    <script src="http://yastatic.net/highlightjs/8.2/highlight.min.js"></script>
</head>

<body>
<?php if (Yii::app()->hasModule('menu')): ?>
    <?php $this->widget('application.modules.menu.widgets.MenuWidget', ['name' => 'top-menu']); ?>
<?php endif; ?>
<!-- container -->
<div class='container'>
    <!-- flashMessages -->
    <?php $this->widget('yupe\widgets\YFlashMessages'); ?>
    <!-- breadcrumbs -->
    <?php $this->widget(
        'bootstrap.widgets.TbBreadcrumbs',
        [
            'links' => $this->breadcrumbs,
        ]
    );?>
    <div class="row">
        <!-- content -->
        <section class="col-sm-9 content">
            <?php echo $content; ?>
        </section>
        <!-- content end-->

        <!-- sidebar -->
        <aside class="col-sm-3 sidebar">
            <?php if (Yii::app()->hasModule('blog')): ?>
                <?php Yii::import('application.modules.blog.BlogModule');?>
                <p>
                    <?= CHtml::link(
                        "<i class='glyphicon glyphicon-pencil'></i> " . Yii::t('BlogModule.blog', 'Add a post'),
                        ['/blog/publisher/write'],
                        ['class' => 'btn btn-success', 'style' => 'width: 100%;']);
                    ?>
                </p>
            <?php endif; ?>
            <?php if (Yii::app()->hasModule('cart')): ?>
                <div class="widget shopping-cart-widget" id="shopping-cart-widget">
                    <?php $this->widget('application.modules.cart.widgets.ShoppingCartWidget'); ?>
                </div>
            <?php endif; ?>




            <?php if (Yii::app()->user->isAuthenticated()): ?>
                <div class="widget last-login-users-widget">
                    <?php $this->widget('application.modules.user.widgets.ProfileWidget'); ?>
                </div>
            <?php endif; ?>

            <?php if (Yii::app()->hasModule('blog')): ?>
                <div class="widget stream-widget">
                    <?php $this->widget('application.modules.blog.widgets.StreamWidget', ['cacheTime' => 300]); ?>
                </div>

                <div class="widget last-posts-widget">
                    <?php $this->widget(
                        'application.modules.blog.widgets.LastPostsWidget',
                        ['cacheTime' => $this->yupe->coreCacheTime]
                    ); ?>
                </div>

                <div class="widget blogs-widget">
                    <?php $this->widget(
                        'application.modules.blog.widgets.BlogsWidget',
                        ['cacheTime' => $this->yupe->coreCacheTime]
                    ); ?>
                </div>

                <div class="widget tags-cloud-widget">
                    <?php $this->widget('application.modules.blog.widgets.TagCloudWidget', ['limit' => 50]); ?>
                </div>
            <?php endif; ?>

            <?php if (Yii::app()->hasModule('feedback')): ?>
                <div class="widget last-questions-widget">
                    <?php $this->widget(
                        'application.modules.feedback.widgets.FaqWidget',
                        ['cacheTime' => $this->yupe->coreCacheTime]
                    ); ?>
                </div>
            <?php endif; ?>

        </aside>
        <!-- sidebar end -->
    </div>
    <!-- footer -->
    <?php $this->renderPartial('//layouts/_footer'); ?>
    <!-- footer end -->
</div>
<div class='notifications top-right' id="notifications"></div>
<!-- container end -->
<?php if (Yii::app()->hasModule('contentblock')): ?>
    <?php $this->widget(
        "application.modules.contentblock.widgets.ContentBlockWidget",
        ["code" => "STAT", "silent" => true]
    ); ?>
<?php endif; ?>
</body>
</html>
