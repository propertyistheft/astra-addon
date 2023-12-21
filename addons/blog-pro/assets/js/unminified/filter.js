
const masonryEnabled  = astra.masonryEnabled || false;
const revealEffectEnable  = astra.revealEffectEnable || false;
const blogArchiveTitleLayout =  astra.blogArchiveTitleLayout || '';

function domReady(fn) {
    // If we're early to the party
    document.addEventListener("DOMContentLoaded", fn);
    // If late; I mean on time.
    if (document.readyState === "interactive" || document.readyState === "complete" ) { 
        fn();
    }
}

domReady(() => {
    const filterList  = document.querySelectorAll('.ast-post-filter li');
    if( filterList ) {
        filterList.forEach( single => {
            single.addEventListener( 'click', function(e) {
                filterList.forEach(element => {
                    element.classList.remove('active');
                });
                e.currentTarget.classList.add('active');

                const dataFilter = e.target.getAttribute('data-filter') ? e.target.getAttribute('data-filter') : '';
                const dataValue =  e.currentTarget.getAttribute('value') ? e.currentTarget.getAttribute('value') : '';
                ArticleMarkup(dataFilter, dataValue);
            });
        });
    }
});


function ArticleMarkup(url, value) {
    document.querySelector('.ast-row').style.opacity = .1;
    const request = new XMLHttpRequest();
        request.open('GET', url, true);
        request.send();
        request.onload = function() {
            const string = request.response;

            const data = new DOMParser().parseFromString(string, 'text/html');
            const boxes = data.querySelectorAll( 'article.ast-article-post' );

            // Pagination for archive blog.
            const paginationSelector = '.ast-ajax-pagination-wrapper';
            const paginationWrapper = document.querySelector(paginationSelector);
            const paginationHtml = data.querySelector(paginationSelector);

            // Pagination numbers for archive blog.
            const paginationTypeNumberSelector = '.ast-pagination';
            const paginationTypeNumberWrapper = document.querySelector(paginationTypeNumberSelector);
            const paginationTypeNumberHtml = data.querySelector(paginationTypeNumberSelector);

            if( paginationTypeNumberWrapper ) {
                paginationTypeNumberWrapper.innerHTML = '';
                if( paginationTypeNumberHtml?.innerHTML ) {
                    paginationTypeNumberWrapper.innerHTML = paginationTypeNumberHtml.innerHTML;
                }
            }

            document.querySelector('#main > .ast-row').innerHTML = '';
            //	Append articles
            for (let boxCount = 0; boxCount < boxes.length; boxCount++) {
                document.querySelector('#main > .ast-row').append(boxes[boxCount]);
            }

            if( 'layout-1' === blogArchiveTitleLayout || ! blogArchiveTitleLayout  ) {
                BlogBannerLayoutRender(data, '.ast-archive-description', value);
            }

            if( 'layout-2' === blogArchiveTitleLayout ) {
                BlogBannerLayoutRender(data, '.ast-archive-entry-banner', value);
            }

            if( paginationWrapper ) {
                paginationWrapper.innerHTML = '';
                if( paginationHtml?.innerHTML ) {
                    paginationWrapper.innerHTML = paginationHtml.innerHTML;
                    const currentPageData = paginationWrapper.querySelector('.ast-pagination-infinite');
                    currentPageData ? currentPageData.setAttribute('data-page', 2) : '';
                }
            }

           window.history.pushState({}, null, url);

            const grid_layout 	= astra.grid_layout || '3';

            //	Append articles
            if( 1 == masonryEnabled && grid_layout > 1 ) {
                const grid = document.querySelector('#main > .ast-row');
                const msnry = new Masonry( grid, {});

                imagesLoaded( document.querySelector('#main > .ast-row'), function() {
                    msnry.appended( boxes );
                    msnry.reloadItems();
                    msnry.layout();
                });
            }

            document.querySelector('.ast-row').style.opacity = 1;

            if( revealEffectEnable ) {
                fadin('.ast-fade-up', { delay: 200 });
            }
            
        }
}

function BlogBannerLayoutRender( data, titleSelector, value ) {
    // Heading for archive for layouts.
    const titleWrapper = document.querySelector(titleSelector);
    const titleHtml = data.querySelector(titleSelector);
    if( titleWrapper ) {
        if( 'layout-1' === blogArchiveTitleLayout ){
            titleWrapper.style.display = ('all' === value) ? 'none' : 'block'; 
        }
        if( titleHtml?.innerHTML ) {
            titleWrapper.innerHTML = '';
            titleWrapper.innerHTML = titleHtml.innerHTML;
        }
    }
}