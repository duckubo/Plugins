<script>
    $(document).ready(function () {
        $('#exampleMT').dataTable({
            "oLanguage": {
                "sInfo": "Hiển thị từ _START_ đến _END_ của _TOTAL_ bản ghi",
                "sSearch": "Tìm Kiếm",
                "oPaginate": {
                    "sPrevious": "Trước",
                    "sNext": "Tiếp",
                }
            },
            "iDisplayLength": 25,
            //"bLengthChange": false,
            //"bFilter": false,
            "aoColumnDefs": [
                { "aTargets": [0], bSortable: false },
                { "aTargets": [9], bSortable: false },
                { "aTargets": [10], bSortable: false },
            ]
        });
    });
    $('.ScheduleTest').addClass('active');
    $('.ScheduleTestTable').addClass('active');
    $('#User').select2();
    $('.Devicetable').addClass('active');
    $('.seachRoom').select2();
    $('.searchType').select2();

    // Export to exel
    function fnExcelReport() {
        var TypeOfDevice = $('#TypeOfDevice').val();
        var Status = $('#Status').val();
        var Guarantee = $('#Guarantee').val();
        var ProjectDKC = $('#ProjectDKC').val();
        var DeviceCode = $('#DeviceCode').val();
        $.ajax({
            url: "/Device/ExportToExcel",
            data: {
                TypeOfDevice: TypeOfDevice,
                Status: Status,
                Guarantee: Guarantee,
                Project: ProjectDKC,
                DeviceCode: DeviceCode
            },
            success: function (response) {
                response = response.replace("DeviceCode", "Mã Thiết Bị ");
                response = response.replace("DeviceName", "Tên Thiết Bị");
                response = response.replace("TypeName", "Tên Loại");
                response = response.replace("PriceOne", "Giá");
                response = response.replace("FullName", "Tên Người Dùng");
                response = response.replace("Configuration", "Cấu Hình");
                response = response.replace("Name", "Nhà Cung Cấp");
                response = response.replace("ProjectSymbol", "Mã Phòng");
                response = response.replace("Status", "Trạng Thái");

                var ua = window.navigator.userAgent;
                var msie = ua.indexOf("MSIE ");
                if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:s11\./))      // If Internet Explorer
                {
                    txtArea1.document.open("txt/html", "replace");
                    txtArea1.document.write(response);
                    txtArea1.document.close();
                    txtArea1.focus();
                    sa = txtArea1.document.execCommand("SaveAs", true, "Say Thanks to Sumit.xls");
                }
                else                 //other browser not tested on IE 11
                {
                    console.log(response);
                    var a = 1;
                    sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(response));
                }
            }
        })
    }
</script>
