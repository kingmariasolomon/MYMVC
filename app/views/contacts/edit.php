<?php $this->setSiteTitle('Editing '.$this->contact->displayName()); ?>
<?php $this->start('body'); ?>
<div class="col-md-8 col-md-offset-2 well">
    <h2 class="text-center grey">Editing <?=ucwords($this->contact->displayName());?></h2>
    <hr>
    <?php $this->partial('contacts', 'form'); ?>
</div>

<?php $this->end(); ?>