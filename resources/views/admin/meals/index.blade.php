@extends('layouts.admin')
@section('content')
@can('meal_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.meals.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.meal.title_singular') }}
            </a>
        </div>
    </div>
@endcan

@can('meal_delete')
    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.meals.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('quickadmin.qa_all')</a></li> |
            <li><a href="{{ route('admin.meals.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('quickadmin.qa_trash')</a></li>
        </ul>
    </p>
    @endcan

<div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped datatable datatable-meals">
                <thead>
                    <tr>
                          
                        <th>
                            {{ trans('cruds.meal.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.meal.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.meal.fields.category') }}
                        </th>
                        <th>
                            {{ trans('cruds.meal.fields.price') }}
                        </th>
                        <th>
                            {{ trans('cruds.meal.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.meal.fields.photo') }}
                        </th>
                        <th>
                            {{ trans('cruds.meal.fields.position') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody >
                @foreach($meals as $meal)
                    
                        <tr>
                            <td>
                                    {{ $meal->id ?? '' }}
                                </td>
                                <td>
                                    {{ $meal->name ?? '' }}
                                </td>
                                <td class="category-name">
                                    {{ $meal->category->name ?? '' }}
                                </td>
                                <td>
                                    {{ $meal->price ?? '' }}
                                </td>
                                <td>
                                    {{ $meal->description ?? '' }}
                                </td>
                                <td>
                                    @if($meal->photo)
                                        <a href="{{ $meal->photo->getUrl() }}" target="_blank">
                                            <img src="{{ $meal->photo->getUrl('thumb') }}" width="50px" height="50px">
                                        </a>
                                    @endif
                                </td>
                                <td class="position">
                                    {{ $meal->position ?? '' }}
                                </td>

                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('meal_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.meals.restore', $meal->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('meal_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.meals.perma_del', $meal->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('meal_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.meals.show', $meal->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('meal_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.meals.edit', $meal->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('meal_delete')
                                        <form action="{{ route('admin.meals.destroy', $meal->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                        </form>
                                    @endcan

                                </td>
                                @endif

                            </tr>
                         
                 
 
                       
                         
                @endforeach
                    </tbody>
            </table>
        </div>
    </div>



@endsection

@section('scripts')
@parent
<script>
    function sendReorderMealsRequest($category) {
        var items = $category.sortable('toArray', {attribute: 'data-id'});
        var ids = $.grep(items, (item) => item !== "");

        if ($category.find('tr.meal').length) {
            $category.find('.empty-message').hide();
        }
        $category.find('.category-name').text($category.find('tr:first td').text());

        $.post('{{ route('admin.meals.reorder') }}', {
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
                $.post('{{ route('admin.categories.reorder') }}', {
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
@endsection
