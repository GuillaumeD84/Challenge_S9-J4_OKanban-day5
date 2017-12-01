var app = {
  cardsData: {},
  init: function() {
    $('.listNameButton').on('click', app.toggleListNameFields);
    $('.editCardTitle').on('click', app.toggleCardTitleFields);
    $('.validCardTitle').on('click', app.toggleCardTitleFields);
    $('.cancelCardTitle').on('click', app.toggleCardTitleFields);

    $('.validListName').on('click', app.updateListName);
    $('.cancelListName').on('click', app.updateListName);
    $('.validCardTitle').on('click', app.updateCardTitle);
    $('.cancelCardTitle').on('click', app.updateCardTitle);

    $('#addListBtn').on('click', app.createList);
    $('.addCardBtn').on('click', app.createCard);

    $('.removeCard').on('click', app.removeCard);

    // On construit nos listes de drag and drop
    $('.cards').sortable({
      connectWith: '.cards',
      update: app.updateSortCard,
      stop: app.stopSortCard
    });

  },
  toggleCardTitleFields: function(evt) {

    var cardTitle = $(evt.target).closest('.card').children('.cardTitle');
    var cardInput = $(evt.target).closest('.card').children('.cardInput');

    cardTitle.toggle();
    cardInput.toggle();
  },
  updateCardTitle: function(evt) {
    var buttonClicked = $(evt.target).attr('class');

    if(buttonClicked.indexOf('fa-') !== -1) {
      buttonClicked = $(evt.target).parent().attr('class');
    }

    if(buttonClicked.indexOf('valid') !== -1) buttonClicked = 'valid';
    if(buttonClicked.indexOf('cancel') !== -1) buttonClicked = 'cancel';

    // On cible le h2 et l'input concernés par l'édition
    var cardTitle = $(evt.target).closest('.card').find('.cardTitle .title');
    var cardInput = $(evt.target).closest('.card').find('.inputCardTitle');

    var cardId = cardInput.attr('data-id');

    // Si l'utilisateur à modifié le nom de la carte on effectue des actions
    if (cardInput.val() !== '') {

      if (buttonClicked === 'valid') {
        // On récupère le nouveau nom depuis l'input
        var newTitle = cardInput.val();

        // On remplace le nom de la carte dans h2 par le nouveau
        // et on met en majuscule la première lettre
        cardTitle.text(newTitle.charAt(0).toUpperCase() + newTitle.slice(1));

        // On éxécute une requête ajax pour mettre à jour la bd
        app.sendNewCardTitleToDB(cardId, newTitle);
      }

      // On supprime le nom inscrit par l'utilisateur dans l'input
      cardInput.val('');
      // On remplace l'ancien placeholder par le nouveau nom
      cardInput.attr('placeholder', cardTitle.text());
    }
  },
  removeCard: function(evt) {
    console.log('remove');
    var card = $(evt.target).closest('.card');
    console.log(card);
  },
  createList: function() {
    var name = $('#addListText').val();

    $.ajax('/Challenges/Challenge_S9-J4_OKanban-j5/list/create', {
      method: 'POST',
      data: {
        name: name
      },
      dataType: 'json',
      success: function(data) {
        console.log(data);
        app.addListToDomTemplate(data);
      }
    });
  },
  createCard: function(evt) {
    var title = $(evt.target).siblings('.addCardText').val();
    if (title === '') return;
    var ordering = $(evt.target).closest('.addCard').attr('data-last-order');
    ordering !== '' ? ordering++ : ordering = 0;
    var list_id = $(evt.target).closest('.addCard').attr('data-list-id');

    $.ajax('/Challenges/Challenge_S9-J4_OKanban-j5/card/create', {
      method: 'POST',
      data: {
        title: title,
        ordering: ordering,
        list_id: list_id
      },
      dataType: 'json',
      success: function(data) {
        console.log(data);
        app.addCardToDomTemplate(data);
      }
    });
  },
  toggleListNameFields: function(evt) {
    var listNameH2 = $(evt.target).closest('.list').children('.listNameH2');
    var listNameInput = $(evt.target).closest('.list').children('.listNameInput');

    listNameH2.toggle();
    listNameInput.toggle();
  },
  updateListName: function(evt) {
    var buttonClicked = $(evt.target).attr('class');

    if(buttonClicked.indexOf('fa-') !== -1) {
      buttonClicked = $(evt.target).parent().attr('class');
    }

    if(buttonClicked.indexOf('valid') !== -1) buttonClicked = 'valid';
    if(buttonClicked.indexOf('cancel') !== -1) buttonClicked = 'cancel';

    // On cible le h2 et l'input concernés par l'édition
    var listNameH2 = $(evt.target).closest('.list').find('.listNameH2 h2');
    var listNameInput = $(evt.target).closest('.list').find('.inputListName');

    var listId = listNameInput.attr('data-id');

    // Si l'utilisateur à modifié le nom de la liste on effectue des actions
    if (listNameInput.val() !== '') {

      if (buttonClicked === 'valid') {
        // On récupère le nouveau nom depuis l'input
        var newName = listNameInput.val();

        // On remplace le nom de la liste dans h2 par le nouveau
        // et on met en majuscule la première lettre
        listNameH2.text(newName.charAt(0).toUpperCase() + newName.slice(1));

        // On éxécute une requête ajax pour mettre à jour la bd
        app.sendNewListNameToDB(listId, newName);
      }

      // On supprime le nom inscrit par l'utilisateur dans l'input
      listNameInput.val('');
      // On remplace l'ancien placeholder par le nouveau nom
      listNameInput.attr('placeholder', listNameH2.text());
    }

  },
  sendNewListNameToDB: function(listId, listNewName) {
    // On effectue une requête ajax en POST
    // avec comme valeurs : id et name
    $.ajax({
      type: 'POST',
      url: '/Challenges/Challenge_S9-J4_OKanban-j5/list/update',
      data: {
        id: listId,
        name: listNewName
      },
      dataType: 'json',
      success: function(title) {
        console.log(title);
      }
    });
  },
  sendNewCardTitleToDB: function(cardId, cardNewTitle) {
    // On effectue une requête ajax en POST
    // avec comme valeurs : id et name
    $.ajax({
      type: 'POST',
      url: '/Challenges/Challenge_S9-J4_OKanban-j5/card/update',
      data: {
        id: cardId,
        title: cardNewTitle
      },
      dataType: 'json',
      success: function(title) {
        console.log(title);
      }
    });
  },
  addListToDomTemplate: function(data) {

    var template = `
    <div class="list">

        <div class="listNameH2">
          <div class="d-flex flex-row align-items-center">
            <h2>` + data.name + `</h2>
            <button class="listNameButton editListName ml-auto" type="button" name="button">
              <i class="fa fa-pencil" aria-hidden="true"></i>
            </button>
          </div>
        </div>

        <div class="listNameInput">
          <div class="d-flex flex-row align-items-center">
            <input data-id=${data.id} class="inputListName" type="text" name="listName" placeholder="${data.name}">
            <button class="listNameButton validListName ml-auto" type="button" name="button">
              <i class="fa fa-check" aria-hidden="true"></i>
            </button>
            <button class="listNameButton cancelListName" type="button" name="button">
              <i class="fa fa-times" aria-hidden="true"></i>
            </button>
          </div>
        </div>

    </div>
    `;

    // On affiche la nouvelle liste dans le html
    $('.addList').before(template);
  },
  addCardToDomTemplate: function(data) {

    var template = `
    <div class="card" data-card-id=${data.id}>

      <div class="cardTitle">
        <div class="d-flex flex-row align-items-center">
          <div class="title">${data.title}</div>
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
          <input data-id=${data.id} class="inputCardTitle" type="text" name="cardTitle" placeholder="${data.title}">
          <button class="cardTitleButton validCardTitle ml-auto" type="button" name="button">
            <i class="fa fa-check" aria-hidden="true"></i>
          </button>
          <button class="cardTitleButton cancelCardTitle" type="button" name="button">
            <i class="fa fa-times" aria-hidden="true"></i>
          </button>
        </div>
      </div>

    </div>
    `;

    // On affiche la nouvelle liste dans le html
    var list = $('div[data-list-id=' + data.list_id + '].cards');
    list.append(template);
  },
  // Pour chaque liste mise à jour, on va
  // exécuter cette méthode
  updateSortCard: function(evt, ui) {

    var list = $(this);

    // On crée un objet dans lequel on va stocker
    // l'ordre de la liste qu'on est en train de traiter
    var temp = {};

    // On parcours chaque post-it de la liste
    list.find('.card').each(function() {

      // On récupère les informations du post-it
      var cardId = $(this).data('card-id');
      temp[cardId] = $(this).index();
    });

    // On va stocker tout ça dans notre application
    // pour que ces données puissent être utilisées plus tard
    var listId = list.data('list-id');
    app.cardsData[listId] = temp;
  },
  // Quand on a fini de déplacer un post-it
  // on lance l'enregistrement des données
  stopSortCard: function(evt, ui) {

    // On envoie le nouvel ordre au serveur
    $.ajax('/Challenges/Challenge_S9-J4_OKanban-j5/list/sort', {
      method: 'POST',
      data: app.cardsData,
    });
  }
};

$(app.init);
