//○か×か空欄のいずれか以外の入力があった場合、アラートを表示
$("#submit").click(function () {
    for (var i=0; i<9; i++) {
    if ($(".squarebox").eq(i).val() == "○" || $(".squarebox").eq(i).val() == "×" || $(".squarebox").eq(i).val() == "") {
      continue;
    } else {
      alert("○か×で入力してください");
      return false;
    }
  }
});
$("#makerecord").click(function () {
    for (var i=0; i<9; i++) {
    if ($(".squarebox").eq(i).val() == "○" || $(".squarebox").eq(i).val() == "×" || $(".squarebox").eq(i).val() == "") {
      continue;
    } else {
      alert("○か×で入力してください");
      return false;
    }
  }
});
//過去入力があったものはグレイアウトで入力と編集ができない
$(document).ready(function () {
    for (var i=0; i<9; i++) {
    if ($(".squarebox").eq(i).val() == "○" || $(".squarebox").eq(i).val() == "×") {
        $(".squarebox").eq(i).prop('readonly', true);
    }
  }
});
