@php
$prefix = \App\Helpers\GenerateId::generate(5);
$id = isset($id) ? $id : $prefix;
$name = isset($name) ? $name : '';
$items = isset($items) ? $items : [];
$length = $items->count();
$selected = isset($selected) ? $selected : [];
$classes = isset($classes) ? $classes : '';
$nonSelectedText = isset($nonSelectedText) ? $nonSelectedText : 'Lựa chọn';
$nSelectedText = isset($nSelectedText) ? $nSelectedText : ' lựa chọn';
$nSelect = isset($nSelect) ? $nSelect : 3;
@endphp
<div class="multiple-select">
    <select id="{{ $id }}" name="{{ $name }}" multiple="multiple" style="display: none;">
        @foreach ($items as $item)
            <option value="{{ $item->id }}" {{ $selected[$loop->index] ?? null ? 'selected' : '' }}>
                {{ $item->render_name }}
            </option>
        @endforeach
    </select>
    <button class="multiple-select-toggle {{ $classes ?? '' }}" type="button">
        <span>{{ $nonSelectedText }}</span>
        <i class="las la-sort"></i>
    </button>
    <div class="multiple-select-dropdown">
        @foreach ($items as $key => $item)
            <div class="multiple-select-option">
                <label for="{{ $prefix }}-{{ $key + 1 }}">
                    <input type="checkbox" id="{{ $prefix }}-{{ $key + 1 }}" value="{{ $item->id }}"
                        {{ $selected[$loop->index] ?? null ? 'checked' : '' }} />
                    <span>{{ $item->render_name }}</span>
                </label>
            </div>
        @endforeach
    </div>
</div>

<script>
    $(function() {
        $('.multiple-select-toggle').unbind().click(function() {
            $(this).closest('.multiple-select').toggleClass('show');
        });

        $('#{{ $id }} ~ .multiple-select-dropdown input').on('change', function() {
            const value = $(this).val();

            const container = $(this).closest('.multiple-select');
            const option = container.find('select option[value="' + value + '"]');
            if ($(this).is(':checked')) {
                option.prop('selected', true);
            } else {
                option.prop('selected', false);
            }

            const select = container.find('select');
            const placeholder = container.find('.multiple-select-toggle span');
            if (select.val().length === 0) {
                placeholder.html("{{ $nonSelectedText }}");
            } else if (select.val().length <= {{ $nSelect }}) {
                const values = [];
                const options = select.find('option:selected');
                options.each(function() {
                    values.push($(this).html());
                });
                placeholder.html(values.join(', '));
            } else if (select.val().length === {{ $length }}) {
                placeholder.html("Đã chọn tất cả ({{ $length }})");
            } else {
                placeholder.html(select.val().length + "{{ $nSelectedText }}");
            }
        });

        const container = $('#{{ $id }}').closest('.multiple-select');
        const select = container.find('select');
        const placeholder = container.find('.multiple-select-toggle span');
        if (select.val().length === 0) {
            placeholder.html("{{ $nonSelectedText }}");
        } else if (select.val().length <= {{ $nSelect }}) {
            const values = [];
            const options = select.find('option:selected');
            options.each(function() {
                values.push($(this).html());
            });
            placeholder.html(values.join(', '));
        } else if (select.val().length === {{ $length }}) {
            placeholder.html("Đã chọn tất cả ({{ $length }})");
        } else {
            placeholder.html(select.val().length + "{{ $nSelectedText }}");
        }

        $(document).on("click", function(event) {
            const containers = $('.multiple-select');

            containers.each(function() {
                const container = $(this);
                const target = $(event.target);

                const isElement = container.is(target);
                const isChildElement = container.has(target).length !== 0;

                if (!isElement && !isChildElement) {
                    container.removeClass("show");
                }
            });
        });
    });
</script>
