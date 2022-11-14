<?php
require_once('./inc/header.php');
?>
      <div class="container h-100">
        <div class="row justify-content-center h-50">
          <div class="col-md-6 shadow p-3 pt-5">
            <h2 class="mb-3">Éditer le lien #<?= $_GET['link_id']?></h2>
            <div class="mb-3">
              <form action="./functions.php" method="post">
                <div class="mb-3">
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control"
                      id="new_title"
                      name="new_title"
                      placeholder="Stack overflow"
                    />
                    <label for="title">Titre</label>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="form-floating">
                    <input
                      type="url"
                      class="form-control"
                      id="new_url"
                      name="new_url"
                      placeholder="https://stackoverflow.com"
                    />
                    <label for="url">Lien</label>
                  </div>
                </div>
                <div class="col-md-auto d-flex">
                  <button class="btn btn-primary btn-lg">Enregister</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

<?php
require_once('./inc/footer.php');
?>