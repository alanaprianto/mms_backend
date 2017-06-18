    window.onload = getNews(0);
    
    function getNews($offset) {
      $.ajax({    
        url: "https://kadin-collab.com/kadin-indonesia/list/view_detail/list",
        type: "post",
        data: {
          id: "berita_kadin",
          param: "news",
          sort: "desc",
          order: "year",
          limit: 20,
          offset: $offset
        }
      }).done(function(data) {
        var json = JSON.parse(data);
        var datas = json.data;
        var enews = document.getElementById("wadahnews");
        var epag = document.getElementById("wadahpagination");
        
        enews.innerHTML = "";
        epag.innerHTML = "";

        var pagination = view_pagination(json.numpage, json.ap);
        $(pagination).appendTo(epag);

        for (var i = datas.length - 1; i >= 0; i--) {
          var thedata = datas[i];
          var news = thedata.datas;

          for (var i = news.length - 1; i >= 0; i--) {
            var thenews = news[i];
            var link = thenews.title.replace(/\s+/g, "_");
            var judul = thenews.title;
            var tagline = thenews.tagline;
            var date_publish = thenews.datepublish;

            $("<div class='feed-element'>"+
                "<div>"+
                  "<a target=_blank href='https://devtes.com/portal/kadin-indonesia/news/berita_kadin/"+link+"'>"+
                    "<i class='fa fa-envelope fa-fw'></i>"+
                    "<strong>"+judul+"</strong>"+
                  "</a>"+
                  "<small class='pull-right text-navy'></small>"+
                  "<div>"+tagline+"</div>"+
                  "<small class='text-muted'>"+date_publish+"</small>"+
                "</div>"+
              "</div>").appendTo(enews);
          }
        }
      });
    }

    function view_pagination($numpage, $active)
    {
      var pagination = '';
      var class_active = '';
      var start_number = $active-2;
      
      var next = '';

      if ($active < 3)
      {
        start_number = 1;
      }

      var end_number = $numpage - start_number;
      number_list = $numpage;
      if (end_number >= 4)
      {
        number_list = start_number + 4;
        var next = '<li class="c-next"><a class="upage" href="#" onClick="getNews('+(number_list)+')" data-offset="'+(number_list)+'"><i class="fa fa-angle-right"></i></a></li>';
      }

      var prev = '';
      if (start_number > 1)
      {
        var prev = '<li class="c-prev"><a class="upage" href="#" onClick="getNews('+(start_number-2)+')" data-offset="'+(start_number-2)+'"><i class="fa fa-angle-left"></i></a></li>';
      }

      for(i=start_number; i <= number_list; i++)
      {
        var class_active = '';
        if (i == $active)
        {
          class_active = 'class="c-active"';
        }
        pagination = pagination+'<li '+class_active+'><a class="upage" href="#" onClick="getNews('+(i-1)+')" data-offset="'+(i-1)+'">'+i+'</a></li>';
      }
      return prev+pagination+next;
    }