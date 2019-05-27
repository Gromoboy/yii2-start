<?php

namespace app\models\forms;

class TaskAttachmentsAddForm extends \yii\base\Model
{
    public $taskId;
    /** @var \yii\web\UploadedFile */
    public $attachment;

    private $filename;
    private $filepath;

    private $fullImgDir = '@img/tasks';
    private $previewImgDir = '@img/tasks/small';

    public function rules()
    {
        return [
            [['taskId', 'attachment'], 'required'],
            ['taskId', 'integer'],
            ['attachment', 'file', 'extensions' => ['jpg', 'png']],
        ];
    }

    public function attributeLabels()
    {
        return [
          'attachment' => \Yii::t('app','attachment'),
        ];
    }


    public function save()
    {
        if (!$this->validate()) {

            print_r($this->errors);
//            return false;
        };

        $this->saveUploadedFile();
        $this->createThumbnail();
        return $this->saveInfoToDb();
    }

    private function saveUploadedFile ()
    {
        $randomString = \Yii::$app->security->generateRandomString();
        $this->filename = $randomString . '.' . $this->attachment->getExtension();
        $this->filepath = \Yii::getAlias(
            "{$this->fullImgDir}/{$this->filename}"
        );
        $this->attachment->saveAs(
            $this->filepath
        );
    }

    private function createThumbnail()
    {
        \yii\imagine\Image::thumbnail($this->filepath, 100, 100)
            ->save(\Yii::getAlias("{$this->previewImgDir}/{$this->filename}"));
    }

    private function saveInfoToDB()
    {
        $model = new \app\models\tables\TaskAttachments([
            'task_id' => $this->taskId,
            'path' => $this->filename,
        ]);

        return $model->save();
    }
}