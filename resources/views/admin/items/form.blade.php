@include('common.errors')

    <div class="form-group">
        <label for="itemID">Item ID</label>
        {!! Form::text('itemID', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        <label for="name">Name</label>
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        <label for="release">Release</label>
        {!! Form::select('release', $releases, null, array('class' => 'form-control')) !!}
    </div>
    <div class="form-group">
        <label for="build">Build</label>
        {!! Form::select('build', $builds, null, array('class' => 'form-control')) !!}
    </div>
    <div class="form-group">
        <label for="tags">Tags</label>
        {!! Form::text('tagNames', null, ['class' => 'form-control', 'id' => 'tokenfield-typeahead']) !!}
    </div>
    <div class="form-group">
        <label for="status">Status</label>
        {!! Form::select('status', array('draft' => 'Draft', 'published' => 'Published'), null, array('class' => 'form-control')) !!}
    </div>
    <div class="form-group">
        <label>Description</label>
        <div id="markdown-editor-description">
            {{ $item->description or '' }}
        </div>
        <div>
            <a href="http://assemble.io/docs/Cheatsheet-Markdown.html" target="_blank">Markdown Cheatsheet</a>
        </div>
        {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => '5', 'style' => 'display: none;']) !!}
    </div>
    <div class="form-group">
        <label>Notes</label>
        <div id="markdown-editor-notes">
            {{ $item->notes or '' }}
        </div>
        <div>
            <a href="http://assemble.io/docs/Cheatsheet-Markdown.html" target="_blank">Markdown Cheatsheet</a>
        </div>
        {!! Form::textarea('notes', null, ['class' => 'form-control', 'rows' => '5', 'style' => 'display: none;']) !!}
    </div>

    @if (isset($item) && isset($item->id))
    <div class="form-group attachments">
        <label for="exampleInputPassword1">Attachments</label>
        <table class="table table-striped">
            <colgroup>
                <col class="col-md-6">
                <col class="col-md-3">
                <col class="col-md-3">
            </colgroup>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Type</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($item->attachments as $key => $attachment)
                    <tr id="attachment-{{ $attachment->id }}">
                        <td><a href="#" class="attachment-name" data-pk="{{ $attachment->id }}" data-url="/admin/items/{{ $item->id }}/attachments/{{ $attachment->id }}">{{ $attachment->name }}</a></td>
                        <td>{{ $attachment->attachment->contentType() }}</td>
                        <td>
                            <a href="{{ $attachment->attachment->url() }}" download="download" class="btn btn-info btn-xs download">
                                <span class="glyphicon glyphicon-download" aria-hidden="true"></span> Download
                            </a>
                            <button type="button" class="btn btn-danger btn-xs remove">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Remove
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
    
    @if (isset($item) && isset($item->id))
    <div class="form-group">
        <label for="exampleInputPassword1">Revision History</label>
        <ul>
            @foreach($item->revisionHistory as $history)
              @if($history->key == 'created_at' && !$history->old_value)
                <li>{{ $history->userResponsible()->name }} created this item on {{ $history->newValue() }}</li>
              @else
                <li>{{ $history->userResponsible()->name }} changed {{ $history->fieldName() }} from {{ $history->oldValue() }} to {{ $history->newValue() }}</li>
              @endif
            @endforeach
        </ul>
    </div>
    @endif
{!! Form::close() !!}
<div id="previews" class="dropzone-previews" style="display: none;"></div>
@push('scripts')

@if (isset($item) && isset($item->id))
<script id="attachment-template" type="text/template">
    <tr id="attachment-<%- id %>">
        <td><a href="#" class="attachment-name" data-pk="<%- id %>" data-url="/admin/items/{{ $item->id }}/attachments/<%- id %>"><%- name %></a></td>
        <td><%- attachment_content_type %></td>
        <td>
            <a href="<%- attachment.original.url %>" target="_blank" class="btn btn-info btn-xs download">
                <span class="glyphicon glyphicon-download" aria-hidden="true"></span> Download
            </a>
            <button type="button" class="btn btn-danger btn-xs remove">
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Remove
            </button>
        </td>
    </tr>
</script>
@endif

<script type="text/javascript">
    var nanobar = new Nanobar({
        bg: '#acf',
        id: 'mynano'
    });

    $('.attachment-name').editable({
        ajaxOptions: {
            type: 'put',
            dataType: 'json',
            headers: {
                'X-CSRF-Token': $('input[name="_token"]').val()
            }
        },
        mode: 'inline',
        type: 'text',
        name: 'name',
        title: 'Enter name'
    });

    var descriptionEditor = $('#markdown-editor-description').markdownEditor({
        preview: true,
        onPreview: function (content, callback) {

        // Example of implementation with ajax:
        $.ajax({
          url: '/admin/items/md-preview',
          type: 'POST',
          dataType: 'html',
          headers: {
            'X-CSRF-Token': $('input[name="_token"]').val()
        },
          data: {content: content},
        })
        .done(function(result) {
          // Return the html:
          callback(result);
        });
      }
    });
    descriptionEditor = ace.edit($(descriptionEditor).find('.md-editor')[0]);
    var notesEditor = $('#markdown-editor-notes').markdownEditor({
        preview: true,
        onPreview: function (content, callback) {

        // Example of implementation with ajax:
        $.ajax({
          url: '/admin/items/md-preview',
          type: 'POST',
          dataType: 'html',
          headers: {
            'X-CSRF-Token': $('input[name="_token"]').val()
          },
          data: {content: content},
        })
        .done(function(result) {
          // Return the html:
          callback(result);
        });
      }
    });
    notesEditor = ace.edit($(notesEditor).find('.md-editor')[0]);

    descriptionEditor.getSession().on('change', function () {
       $('textarea[name="description"]').val(descriptionEditor.getSession().getValue());
    });

    notesEditor.getSession().on('change', function () {
       $('textarea[name="notes"]').val(notesEditor.getSession().getValue());
    });

    @if (isset($item) && isset($item->id))
    Dropzone.autoDiscover = false;

    var myDropzone = new Dropzone("body",
        {
            url: "/admin/items/{{ $item->id }}/attachments",
            paramName: 'attachment',
            headers: {
                'X-CSRF-Token': $('input[name="_token"]').val()
            },
            previewsContainer: "#previews",
            clickable: "#previews"
            // acceptedFiles: 'audio/*,image/*,.psd,.pdf'
        }
    )
    .on('success', function(file, responseText) {
        var template = _.template($('#attachment-template').html());

        $('.attachments table tbody').append(template(responseText));

        $('.attachment-name').editable({
            ajaxOptions: {
                type: 'put',
                dataType: 'json',
                headers: {
                    'X-CSRF-Token': $('input[name="_token"]').val()
                }
            },
            mode: 'inline',
            type: 'text',
            name: 'name',
            title: 'Enter name'
        });
    })
    .on('totaluploadprogress', function(uploadProgress, totalBytes, totalBytesSent) {
        nanobar.go(uploadProgress);
    });

    $('.attachments table tbody').on('click', '.btn.remove', function(evt) {
        if(! confirm("Delete Attachment?")) {
            return;
        }

        var attachmentId = $(this).parents('tr').attr('id').replace('attachment-', '');

        $.ajax({
            url: "/admin/items/{{ $item->id }}/attachments/" + attachmentId,
            type: 'DELETE',
            headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
            }
        })
        .done(function(data) {
            $('#attachment-' + attachmentId).remove();
        });
    });
    @endif

    var engine = new Bloodhound({
      local: [
        @foreach ($typeahead_tags as $tag)
            {value: '{{ $tag->name }}'},
        @endforeach
      ],
      datumTokenizer: function(d) {
        return Bloodhound.tokenizers.whitespace(d.value);
      },
      queryTokenizer: Bloodhound.tokenizers.whitespace
    });

    engine.initialize();

    $('#tokenfield-typeahead').tokenfield({
      createTokensOnBlur: true,
      typeahead: [null, { source: engine.ttAdapter() }]
    });
</script>

@endpush