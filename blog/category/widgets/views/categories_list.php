<?php

use yii\bootstrap\Html;
use blog\category\helpers\CategoryUrl;
use blog\post\helpers\PostUrl;

if ($canSetRelation) {
    echo Html::beginForm([
        '/post/savePostCategoriesRelation', 
        'post_id' => $postId
    ]);
}

?>

<div style="margin-bottom: 50px;">
    <div style="font-size: 16px;margin-bottom: 10px;">
        <?= Yii::t('category', 'Categories') ?>
    </div>
    <div>
        <?php foreach ($categoriesList as $categoryRowData): ?>
            <div>
                <?php
                
                if ($canSetRelation) {
                    echo Html::checkbox(
                        'categoryIds[' . $categoryRowData['id'] . ']', 
                        in_array($categoryRowData['id'], $postBoundWithCategoryIds)
                    );
                }
                  
                echo Html::a(
                    $categoryRowData['name'], 
                    PostUrl::showListByCategory($categoryRowData['id'])
                ); 
                
                if ($canManageCategories) {
                    echo Html::a(
                        '<span class="glyphicon glyphicon-pencil"></span>', 
                        CategoryUrl::edit($categoryRowData['id'])    
                    ); 
                    echo Html::a(
                        '<span class="glyphicon glyphicon-trash"></span>', 
                        CategoryUrl::delete($categoryRowData['id'])
                    );
                } 
                ?>
            </div>
        
        <?php endforeach; ?>
    </div>
</div>

<?php 
if ($canSetRelation && $categoriesList) {
    echo Html::submitButton(Yii::t('app', 'Save'), [
        'class' => 'btn btn-primary btn-xs']);
    echo Html::endForm();
}