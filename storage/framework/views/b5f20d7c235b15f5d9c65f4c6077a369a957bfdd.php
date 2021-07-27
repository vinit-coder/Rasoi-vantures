
<?php $__env->startSection('content'); ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('meal_create')): ?>
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="<?php echo e(route('admin.meals.create')); ?>">
                <?php echo e(trans('global.add')); ?> <?php echo e(trans('cruds.meal.title_singular')); ?>

            </a>
        </div>
    </div>
<?php endif; ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('meal_delete')): ?>
    <p>
        <ul class="list-inline">
            <li><a href="<?php echo e(route('admin.meals.index')); ?>" style="<?php echo e(request('show_deleted') == 1 ? '' : 'font-weight: 700'); ?>"><?php echo app('translator')->get('quickadmin.qa_all'); ?></a></li> |
            <li><a href="<?php echo e(route('admin.meals.index')); ?>?show_deleted=1" style="<?php echo e(request('show_deleted') == 1 ? 'font-weight: 700' : ''); ?>"><?php echo app('translator')->get('quickadmin.qa_trash'); ?></a></li>
        </ul>
    </p>
    <?php endif; ?>

<div class="panel panel-default">
        <div class="panel-heading">
            <?php echo app('translator')->get('quickadmin.qa_list'); ?>
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped datatable datatable-meals">
                <thead>
                    <tr>
                          
                        <th>
                            <?php echo e(trans('cruds.meal.fields.id')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.meal.fields.name')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.meal.fields.category')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.meal.fields.price')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.meal.fields.description')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.meal.fields.photo')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.meal.fields.position')); ?>

                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody >
                <?php $__currentLoopData = $meals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $meal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                        <tr>
                            <td>
                                    <?php echo e($meal->id ?? ''); ?>

                                </td>
                                <td>
                                    <?php echo e($meal->name ?? ''); ?>

                                </td>
                                <td class="category-name">
                                    <?php echo e($meal->category->name ?? ''); ?>

                                </td>
                                <td>
                                    <?php echo e($meal->price ?? ''); ?>

                                </td>
                                <td>
                                    <?php echo e($meal->description ?? ''); ?>

                                </td>
                                <td>
                                    <?php if($meal->photo): ?>
                                        <a href="<?php echo e($meal->photo->getUrl()); ?>" target="_blank">
                                            <img src="<?php echo e($meal->photo->getUrl('thumb')); ?>" width="50px" height="50px">
                                        </a>
                                    <?php endif; ?>
                                </td>
                                <td class="position">
                                    <?php echo e($meal->position ?? ''); ?>

                                </td>

                                <?php if( request('show_deleted') == 1 ): ?>
                                <td>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('meal_delete')): ?>
                                                                        <?php echo Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.meals.restore', $meal->id])); ?>

                                    <?php echo Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')); ?>

                                    <?php echo Form::close(); ?>

                                <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('meal_delete')): ?>
                                                                        <?php echo Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.meals.perma_del', $meal->id])); ?>

                                    <?php echo Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')); ?>

                                    <?php echo Form::close(); ?>

                                <?php endif; ?>
                                </td>
                                <?php else: ?>
                                <td>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('meal_show')): ?>
                                        <a class="btn btn-xs btn-primary" href="<?php echo e(route('admin.meals.show', $meal->id)); ?>">
                                            <?php echo e(trans('global.view')); ?>

                                        </a>
                                    <?php endif; ?>

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('meal_edit')): ?>
                                        <a class="btn btn-xs btn-info" href="<?php echo e(route('admin.meals.edit', $meal->id)); ?>">
                                            <?php echo e(trans('global.edit')); ?>

                                        </a>
                                    <?php endif; ?>

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('meal_delete')): ?>
                                        <form action="<?php echo e(route('admin.meals.destroy', $meal->id)); ?>" method="POST" onsubmit="return confirm('<?php echo e(trans('global.areYouSure')); ?>');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                            <input type="submit" class="btn btn-xs btn-danger" value="<?php echo e(trans('global.delete')); ?>">
                                        </form>
                                    <?php endif; ?>

                                </td>
                                <?php endif; ?>

                            </tr>
                         
                 
 
                       
                         
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
            </table>
        </div>
    </div>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
<script>
    function sendReorderMealsRequest($category) {
        var items = $category.sortable('toArray', {attribute: 'data-id'});
        var ids = $.grep(items, (item) => item !== "");

        if ($category.find('tr.meal').length) {
            $category.find('.empty-message').hide();
        }
        $category.find('.category-name').text($category.find('tr:first td').text());

        $.post('<?php echo e(route('admin.meals.reorder')); ?>', {
                _token,
                ids,
                category_id: $category.data('id')
            })
            .done(function (response) {
                $category.children('tr.meal').each(function (index, meal) {
                    $(meal).children('.position').text(response.positions[$(meal).data('id')])
                });
            })
            .fail(function (response) {
                alert('Error occured while sending reorder request');
                location.reload();
            });
    }

    $(document).ready(function () {
        var $categories = $('table');
        var $meals = $('.sortable');

        $categories.sortable({
            cancel: 'thead',
            stop: () => {
                var items = $categories.sortable('toArray', {attribute: 'data-id'});
                var ids = $.grep(items, (item) => item !== "");
                $.post('<?php echo e(route('admin.categories.reorder')); ?>', {
                        _token,
                        ids
                    })
                    .fail(function (response) {
                        alert('Error occured while sending reorder request');
                        location.reload();
                    });
            }
        });

        $meals.sortable({
            connectWith: '.sortable',
            items: 'tr.meal',
            stop: (event, ui) => {
                sendReorderMealsRequest($(ui.item).parent());

                if ($(event.target).data('id') != $(ui.item).parent().data('id')) {
                    if ($(event.target).find('tr.meal').length) {
                        sendReorderMealsRequest($(event.target));
                    } else {
                        $(event.target).find('.empty-message').show();
                    }
                }
            }
        });
        $('table, .sortable').disableSelection();
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/latest-rasoi-banchers/Rasoi_banchers/resources/views/admin/meals/index.blade.php ENDPATH**/ ?>