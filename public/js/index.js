$(function () {

    $('#select-j2').hide();
    $('#select-j3').hide();

    // ラジオボタンのチェックが切り替わったタイミングでセレクトボックスのオプション変更
    $('#radio-j1').change(function () {
        $('#select-j1').show();
        $('#select-j2').hide();
        $('#select-j3').hide();
        judgeButtonActivation();
    });
    $('#radio-j2').change(function () {
        $('#select-j1').hide();
        $('#select-j2').show();
        $('#select-j3').hide();
        judgeButtonActivation();
    });
    $('#radio-j3').change(function () {
        $('#select-j1').hide();
        $('#select-j2').hide();
        $('#select-j3').show();
        judgeButtonActivation();
    });

    // 登録ボタンの活性チェック
    function judgeButtonActivation() {

        const radioVal = $('input[name=division]:checked').val();
        const initialOption = '選択してください';

        if (radioVal === 'j1' && $('.option-j1').val() === initialOption) {
            $('.button').addClass('is-static');

        } else if (radioVal === 'j2' && $('.option-j2').val() === initialOption) {
            $('.button').addClass('is-static');

        } else if (radioVal === 'j3' && $('.option-j3').val() === initialOption) {
            $('.button').addClass('is-static');

        } else {
            $('.button').removeClass('is-static');
        }
    }

    //セレクトボックスが切り替わったら発動
    $('.option-j1').change(function () {
        const division = $('#radio-j1').val();
        const club = $(this).val();
        if (division === 'j1' && club) {
            $('.button').removeClass('is-static');
            fetchCalendarUrl();
        }
    });

    $('.option-j2').change(function () {
        const division = $('#radio-j2').val();
        const club = $(this).val();
        if (division === 'j2' && club) {
            $('.button').removeClass('is-static');
            fetchCalendarUrl();
        }
    });

    $('.option-j3').change(function () {
        const division = $('#radio-j3').val();
        const club = $(this).val();
        if (division === 'j3' && club) {
            $('.button').removeClass('is-static');
            fetchCalendarUrl();
        }
    });

    function fetchCalendarUrl() {

        const division = $('input[name=division]:checked').val();
        let club = '';
        if (division === 'j1') {
            club = $('.option-j1').val();
        } else if (division === 'j2') {
            club = $('.option-j2').val();
        } else {
            club = $('.option-j3').val();
        }

        $.ajax({
            url: '/jleague/calendar/url',
            type: 'POST',
            data: {
                'club': club
            }
        }).done((result) => {
            // 現在のタブで開く
            // window.location.href = result['url'];
            // 新規タブで開く
            // window.open(result['url']);
            // 登録ボタンにhref属性を追加
            $('#gcal').attr('href', result['url']);
        }).fail(() => {
            window.alert('処理に失敗しました。時間をおいて再度実行してください。');
        });
    }

});
