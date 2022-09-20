function deleteData(id) {
    'use strict'

    if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
        document.getElementById("form_" + id).submit();
    }
}

function deleteComment(id) {
    'use strict'

    if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
        document.getElementById("form" + id).submit();
    }
}