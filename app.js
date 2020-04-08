$(function() {
  console.log("jQuery Works!");
  $("#task-result").hide();
  let edit = false;
  fetchTasks();

  function fetchTasks() {
    $.ajax({
      url: "task-list.php",
      type: "GET",
      success: function(res) {
        let tasks = JSON.parse(res);
        let template = "";

        tasks.forEach(element => {
          template += `
                    <tr taskid="${element.id}">
                        <td>${element.id}</td>
                        <td><a href="#" class="task-item">${element.name}</a></td>
                        <td>${element.description}</td>
                        <td>
                            <button class="task-delete btn btn-danger">Delete</button>
                        </td>
                    </tr>          
                  `;
        });

        $("#tasks").html(template);
      }
    });
  }

  $("#search").keyup(function() {
    var search = $(this).val();

    if (search) {
      $.ajax({
        url: "task-search.php",
        type: "post",
        data: { search },
        success: function(res) {
          let tasks = JSON.parse(res);

          let template = "";

          tasks.forEach(element => {
            template += `<li>
                            ${element.name}
                        </li>`;
          });

          $("#container").html(template);
          if (template) {
            $("#task-result").show();
          }
        }
      });
    } else {
      $("#task-result").hide();
    }
  });

  $("#task-form").submit(function(e) {
    e.preventDefault();
    const postData = {
      id: $("#taskID").val(),
      name: $("#name").val(),
      description: $("#description").val()
    };

    let url = edit === false ? "task-add.php" : "task-edit.php";

    $.post(url, postData, function(res) {
      $("#task-form").trigger("reset");
      console.log(res);
      fetchTasks();
    });
  });

  $(document).on("click", ".task-delete", function() {
    if (confirm("Are you sure you want to delete it?")) {
      let element = $(this)[0].parentElement.parentElement;

      let id = $(element).attr("taskid");

      $.post("task-delete.php", { id }, function(res) {
        fetchTasks();
      });
    }
  });

  $(document).on("click", ".task-item", function() {
    let element = $(this)[0].parentElement.parentElement;
    let id = $(element).attr("taskid");

    $.post("task-single.php", { id }, function(res) {
      const task = JSON.parse(res);

      $("#taskID").val(task.id);
      $("#name").val(task.name);
      $("#description").val(task.description);
      edit = true;
    });
  });
});
