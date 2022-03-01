<section class="content">
    <div class="row">
        <div class="col-md-12">
            <style>
                .output-body {
                    white-space: pre-wrap;
                    background: #000000;
                    color: #00fa4a;
                    padding: 10px;
                    border-radius: 0;
                }

            </style>
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-striped table-hover">
                        <tbody>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Task</th>
                            <th>Description</th>
                            <th>Run</th>
                        </tr>
                        <tr>
                            <td>1.</td>
                            <td><code>同步杂志数据</code></td>
                            <td>点击RUN按钮，开始同步杂志数据写入数据库。</td>
                            <td><a class="btn btn-xs btn-primary run-task" data-id="1">Run</a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>

            <div class="box box-default output-box hide" id="output-box">
                <div class="box-header with-border">
                    <i class="fa fa-terminal"></i>
                    <h3 class="box-title">Output</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body" id="box-body">
                    <pre class="output-body"></pre>
                    <pre class="output-body"></pre>
                </div>

                <!-- /.box-body -->
            </div>
        </div>
    </div>
</section>

<div class="modal" tabindex="-1" role="dialog" id="app-admin-actions-feedback">
    <script data-exec-on-popstate="">
        $(function () {
            $('.run-task').click(function (e) {
                var id = $(this).data('id');
                NProgress.start();
                $.ajax({
                    method: 'GET',
                    url: '/api/synchronize',
                    success: function (data) {
                        if ((typeof data) == 'object' && data.msg == 'success') {
                            $('.output-box').removeClass('hide');
                            for(var value of data.info)
                            {
                                $('.output-box .output-body').html("<pre class='output-body'>"+value+" is done</pre>");
                            }
                        }
                        NProgress.done();
                    }
                });
            });
        });
    </script>
</div>
