<div class="row">

  <main id="board">
    <div id="lists" class="d-flex flex-row">

      <?php foreach($params as $list): ?>
      <div class="list">

          <div class="listNameH2">
            <div class="d-flex flex-row align-items-center">
              <h2><?= $list->getName(); ?></h2>
              <button class="listNameButton editListName ml-auto" type="button" name="button">
                <i class="fa fa-pencil" aria-hidden="true"></i>
              </button>
            </div>
          </div>

          <div class="listNameInput">
            <div class="d-flex flex-row align-items-center">
              <input data-id=<?= $list->getId(); ?> class="inputListName" type="text" name="listName" placeholder="<?= $list->getName(); ?>">
              <button class="listNameButton validListName ml-auto" type="button" name="button">
                <i class="fa fa-check" aria-hidden="true"></i>
              </button>
              <button class="listNameButton cancelListName" type="button" name="button">
                <i class="fa fa-times" aria-hidden="true"></i>
              </button>
            </div>
          </div>

        <div class="cards" data-list-id="<?= $list->getId(); ?>">

          <?php foreach($list->getCards() as $card): ?>
            <div class="card" data-card-id="<?= $card->getId(); ?>">

              <div class="cardTitle">
                <div class="d-flex flex-row align-items-center">
                  <div class="title"><?= $card->getTitle(); ?></div>
                  <button class="cardTitleButton editCardTitle ml-auto" type="button" name="button">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                  </button>
                  <button class="cardTitleButton removeCard" type="button" name="button">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                  </button>
                </div>
              </div>

              <div class="cardInput">
                <div class="d-flex flex-row align-items-center">
                  <input data-id=<?= $card->getId(); ?> class="inputCardTitle" type="text" name="cardTitle" placeholder="<?= $card->getTitle(); ?>">
                  <button class="cardTitleButton validCardTitle ml-auto" type="button" name="button">
                    <i class="fa fa-check" aria-hidden="true"></i>
                  </button>
                  <button class="cardTitleButton cancelCardTitle" type="button" name="button">
                    <i class="fa fa-times" aria-hidden="true"></i>
                  </button>
                </div>
              </div>

            </div>
          <?php endforeach; ?>

        </div>

        <div class="card addCard" data-list-id="<?= $list->getId(); ?>" data-last-order="<?= $list->getLastCardOrder(); ?>">
          <div class="createCard">
            <label for="addCardText">Nouvelle carte</label>
            <input id="addCardBtn<?= $list->getId(); ?>" class="addCardBtn" type="button" value="ADD">
            <input id="addCardText<?= $list->getId(); ?>" class="addCardText" type="text" placeholder="Ma géniallissime carte !">
          </div>
        </div>

      </div>
      <?php endforeach; ?>

      <div class="list addList">
        <div class="createList">
          <label for="addListText">Nouvelle liste</label>
          <input id="addListBtn" type="button" value="ADD">
          <input id="addListText" type="text" placeholder="Ma super liste !">
        </div>
      </div>

    </div>
  </main>
</div>
