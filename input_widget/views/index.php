<?php
/**
 * @var View $this
 */
use yii\helpers\Html;
use yii\web\View;

?>
<?php $sid = uniqid() ?>

<ul class="nav nav-tabs" role="tablist">
	<?php foreach ($this->context->model->mlConfig['languages'] as $languageCode => $languageName): ?>

		<li class="<?= (Yii::$app->language == $languageCode) ? 'active' : '' ?>">
			<a href="#<?= $sid . $languageCode ?>" role="tab" data-toggle="tab">
				<?= $languageName ?>
			</a>
		</li>
	<?php endforeach ?>

</ul>

<div class="tab-content">

	<?php foreach ($this->context->model->mlConfig['languages'] as $languageCode => $languageName): ?>

		<?php
		$attribute = $this->context->attribute;

		if ( $languageCode != $this->context->model->mlConfig['default_language'] )
		{
			$attribute .= '_' . $languageCode;
		}

		$activeClass = (Yii::$app->language == $languageCode) ? 'active' : '';
		?>


		<div class="tab-pane <?= $activeClass ?>" id="<?= $sid . $languageCode ?>">

			<?php if(get_class($this->context->model) == 'app\easyii\modules\carousel\models\Carousel'  &&  ($attribute=='video' || $attribute=='video_ru')) : ?>

				<?php if (isset($this->context->model->$attribute) && !empty($this->context->model->$attribute)) : ?>

					<div style="margin: 10px 0">
						<?php if(\app\components\Utils::isImageFile(\Yii::getAlias('@webroot').$this->context->model->$attribute)){ ?>

							<img width=400px" src="<?= $this->context->model->$attribute ?>" alt="">

						<?php } else { ?>

							<video width=400px" preload="none" autoplay>
								<source src="<?= $this->context->model->$attribute ?>" type='video/mp4' />
							</video>

						<?php } ?>
					</div>

                    <div style="margin: 10px 0"><?= file_exists(\Yii::getAlias('@webroot').$this->context->model->$attribute) ? '<a href="'. $this->context->model->$attribute .'" target="_blank">'. basename($this->context->model->$attribute).'</a>' . '  ('.   (filesize(\Yii::getAlias('@webroot').$this->context->model->$attribute)/1000000) . ' Mb)' : 'File not exist' ?></div>

				<?php endif; ?>

			<?php endif; ?>

			<?php if(get_class($this->context->model) == 'app\easyii\modules\cooperation\models\Cooperation'  &&  ($attribute=='file' || $attribute=='file_ru')) : ?>

				<?php if (isset($this->context->model->$attribute) && !empty($this->context->model->$attribute)) : ?>

					<div style="margin: 10px 0"><?= file_exists(\Yii::getAlias('@webroot').$this->context->model->$attribute) ? '<a href="'. $this->context->model->$attribute .'" target="_blank">'. basename($this->context->model->$attribute).'</a>' . '  ('.   (filesize(\Yii::getAlias('@webroot').$this->context->model->$attribute)/1000000) . ' Mb)' : 'File not exist' ?></div>

				<?php endif; ?>

			<?php endif; ?>

            <?php if(get_class($this->context->model) == 'app\easyii\modules\cooperation\models\Cooperation'  &&  ($attribute=='image' || $attribute=='image_ru')) : ?>

                <?php if (isset($this->context->model->$attribute) && !empty($this->context->model->$attribute)) : ?>

                    <div style="margin: 10px 0">
                        <?php if(file_exists(\Yii::getAlias('@webroot').$this->context->model->$attribute)) : ?>

                            <img width=400px" src="<?= $this->context->model->$attribute ?>" alt="">

                        <?php endif; ?>
                    </div>

                    <div style="margin: 10px 0"><?= file_exists(\Yii::getAlias('@webroot').$this->context->model->$attribute) ? '<a href="'. $this->context->model->$attribute .'" target="_blank">'. basename($this->context->model->$attribute).'</a>' . '  ('.   (filesize(\Yii::getAlias('@webroot').$this->context->model->$attribute)/1000000) . ' Mb)' : 'File not exist' ?></div>

                <?php endif; ?>

            <?php endif; ?>

			<?= $this->context->getInputField($attribute) ?>

		</div>


	<?php endforeach ?>
</div>