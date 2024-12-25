const navLinks = Array.from(document.querySelectorAll('.nav-link'))

navLinks.forEach(link => {
    if(link.href.includes(window.location.pathname)) {
        link.classList.add('active')
    }
});

$(function () {
    $('.ajax-form').on('submit', function (e) {
        e.preventDefault();

        let form = $(this);
        let btn = form.find('button');
        let btnText = btn.text();
        let method = form.attr('method');
        if (method) {
            method = method.toLowerCase();
        }
        let action = form.attr('action') ? form.attr('action') : location.href;

        $.ajax({
            url: action,
            type: method === 'post' ? 'post' : 'get',
            data: form.serialize(),
            beforeSend: function () {
                btn.prop('disabled', true).text('Отправляю...');
            },
            success: function (res) {
                res = JSON.parse(res);
                console.log(res);
            },
            error: function () {
                alert('Error!');
                btn.prop('disabled', false).text(btnText);
            },
        });

    });
})