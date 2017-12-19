<?php $__env->startSection('content'); ?>
  <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default form-group" style="padding:30px;">
                 <h1> The Task</h1>
                 <h2> <?php echo e($task->task); ?></h2>
                 <hr>
                 <h1>The Urgency</h1>
                 <br>
                 <div class="btn btn-urgency" style="border:1px solid <?php echo e($task->color); ?>; color:<?php echo e($task->color); ?>; background-color:white;"><?php echo e($task->desc); ?></div>
                 <br>
                 <hr>

                 <?php if(auth()->user()->id == $task->user_id && !$task->finished): ?>
                    <a href="/tasks/<?php echo e($task->id); ?>/edit" class="btn btn-primary pull-left" style="margin:0 5px 0 0 ;">Edit Task</a>
                    <form action="/tasks/<?php echo e($task->id); ?>" method="POST">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="_method" value="DELETE">
                        <input type="submit" class="btn btn-danger" style="margin:0 0 0 5px;" value="Remove Task">
                    </form>
                 <?php endif; ?>
            </div>
        </div>
    </div>
</div>
  
<?php $__env->stopSection(); ?>










<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>