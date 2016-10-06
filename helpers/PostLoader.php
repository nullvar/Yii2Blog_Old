<?php

namespace app\helpers;

/**
 * @author Anton Karamnov
 */
class PostLoader
{    
    /**
     * @var \yii\db\ActiveRecord 
     */
    protected $model;
    
    /**
     * @var \app\helpers\FileLoader
     */
    protected $fileLoader;
    
    /**
     * @param \yii\db\ActiveRecord $model
     * @param \app\helpers\FileLoader $fileLoader
     */
    public function __construct(
        \yii\db\ActiveRecord $model, FileLoader $fileLoader
    ) {
        $this->model = $model;
        $this->fileLoader = $fileLoader;
    }
    
    /**
     * @return boolean
     */
    public function load() 
    {
        if (!$this->fileLoader->loadFile()) {
            return false;
        }
        
        $content = $this->fileLoader->getFileContent();
        
        $this->model->title = self::findPostTitle($content);
        $this->model->content = $content;
        $this->model->save();
        
        return true;
    }
    
    /**
     * @return string
     */
    protected static function findPostTitle($content) 
    {
        $rows = explode("=", $content);
        return substr(trim($rows[0]), 0, 255);
    }  
    
    /**
     * @return FileLoader
     */
    public function getFileLoader() 
    {
        return $this->fileLoader;
    }
    
    /**
     * @var \yii\db\ActiveRecord 
     */
    public function getModel() 
    {
        return $this->model;
    }
            
}