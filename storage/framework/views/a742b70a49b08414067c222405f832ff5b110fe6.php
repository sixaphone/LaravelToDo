<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default ">
                <div class="panel-heading text-center"><?php echo e(Auth::user()->username); ?>'s ToDos</div>

                <div class="panel-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>
                    <h1 class="text-center"><?php echo e(auth()->user()->firstname); ?> <?php echo e(auth()->user()->lastname); ?></h1>
                        <div class="container-fluid text-center">
                         <div class="btn-group">
                            <a href="/tasks/create"><button type="button" class="btn btn-primary">Add New Task</button></a>
                            <a href="/tasks/filter/date"><button type="button" class="btn btn-primary">Order By Date</button></a>
                            <a href="/tasks/filter/urgency"><button type="button" class="btn btn-primary">Order By Importance</button></a>
                            <a href="/tasks/finished/get"><button type="button" class="btn btn-primary">Show Finished Tasks</button></a>
                        </div> 
                        <h2>Filter by Urgency</h2>
                        <br>
                        <div class="btn-group">
                            <a href="/tasks/"><button type="button" class="btn btn-default">All of it</button></a>
                        
                            <a href="/tasks/get/1"><button type="button" class="btn" style="color:white;background-color:#f1c40f;">Just To Remember</button></a>
                            <a href="/tasks/get/2"><button type="button" class="btn btn-success">Kinda Important</button></a>
                            <a href="/tasks/get/3"><button type="button" class="btn btn-primary">Should do</button></a>
                            <a href="/tasks/get/4"><button type="button" class="btn" style="color:white; background-color:#f39c12;">Really important</button></a>
                            <a href="/tasks/get/5"><button type="button" class="btn btn-danger">Top on my List</button></a>
                        </div> 
                        </div> 
                    <br>                    
                    <?php if(count($tasks)>0): ?>
                        <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="well">
                            <a href="/tasks/<?php echo e($task->id); ?>" style="text-decoration:none; color:#aaaaaa;">
                                    <h3><?php echo e($task->task); ?></h3>
                                    <div class="btn pull-right" style="border:2px solid <?php echo e($task->color); ?>;color:<?php echo e($task->color); ?>;background-color:white;"> <?php echo e($task->desc); ?></div>
                                    <small style="color:#d2d2d2;">Created at: <?php echo e($task->created_at); ?> </small>
                            </a>
                            <?php if(!$task->finished): ?>
                                    <button onclick="confirm(this)" type="button" class="btn btn-success pull-right" data-value="<?php echo e($task->id); ?>" style="margin-right:10px;">Mark Finished</button>
                                    <a href="/tasks/complete/<?php echo e($task->id); ?>" class="btn btn-success pull-right hidden" id="markFinished<?php echo e($task->id); ?>" style="margin-right:10px;"> Click Again If you are sure</a>                                    
                                    <a href="/tasks/<?php echo e($task->id); ?>/edit" class="btn btn-default pull-right" style="margin-right:10px;"> Edit</a>                                    
                                  <?php endif; ?>  
                                </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div class="text-center">
                             <?php echo e($tasks->links()); ?>

                        </div>
                    <?php else: ?>
                        <h2>You are taskless</h2>
                    <?php endif; ?>
                </div>      
            </div>
        </div>
    </div>
</div>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    
    function confirm(e){
        e.style.visibility = "hidden";
        e.style.display = "none";
        $("#markFinished"+e.getAttribute('data-value')).removeClass('hidden');
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>