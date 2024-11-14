
const masonryEnabled  = astra.masonryEnabled || false;
const revealEffectEnable  = astra.revealEffectEnable || false;
const blogArchiveTitleLayout =  astra.blogArchiveTitleLayout || '';
const blogArchiveTitleOn = astra.blogArchiveTitleOn || '';

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

    astNavigationListener();
});

// To add ajax functionality on navigation links.
function astNavigationListener() {
    const links = document.querySelectorAll('.ast-pagination a');
    links?.forEach(link => {
        link?.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            const href = e.target?.getAttribute('href');
            const request = ArticleMarkup(href);

            request.onloadend = () => {
                window.scrollTo({
                    top: document.querySelector('#content')?.offsetTop ?? 0,
                    behavior: "smooth",
                });
            }
        });
    });
}

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

            if ( ! paginationWrapper && paginationHtml ) {
                document.querySelector('#main')?.insertAdjacentElement('afterend', paginationHtml);
            } else if ( paginationWrapper && ! paginationHtml ) {
                paginationWrapper?.remove();
            } else if ( paginationWrapper && paginationHtml?.innerHTML ) {
                paginationWrapper.innerHTML = DOMPurify.sanitize( paginationHtml.innerHTML );
            }

            // Pagination numbers for archive blog.
            const paginationTypeNumberSelector = '.ast-pagination';
            const paginationTypeNumberWrapper = document.querySelector(paginationTypeNumberSelector);
            const paginationTypeNumberHtml = data.querySelector(paginationTypeNumberSelector);

            // Handling creation and removal of pagination container.
            if ( ! paginationTypeNumberWrapper && paginationTypeNumberHtml ) {
                document.querySelector('#main')?.insertAdjacentElement('afterend', paginationTypeNumberHtml);
            } else if ( paginationTypeNumberWrapper && ! paginationTypeNumberHtml ) {
                paginationTypeNumberWrapper?.remove();
            } else if ( paginationTypeNumberWrapper && paginationTypeNumberHtml?.innerHTML ) {
                paginationTypeNumberWrapper.innerHTML = DOMPurify.sanitize( paginationTypeNumberHtml.innerHTML );
            }

            // Updating window title.
            document.title = data?.title || document.title;

            // For loading pagination style.
            if (
                document.querySelector("#astra-theme-css-inline-css") &&
                data.querySelector("#astra-theme-css-inline-css")
            ) {
                document.querySelector("#astra-theme-css-inline-css").innerHTML = DOMPurify.sanitize( data.querySelector("#astra-theme-css-inline-css").innerHTML );
            } else if ( // When file generation option is active.
                document.querySelector("#astra-theme-dynamic-css") &&
                data.querySelector("#astra-theme-dynamic-css")
            ) {
                document.querySelector("#astra-theme-dynamic-css")
                    ?.setAttribute(
                        "href",
                        data.querySelector("#astra-theme-dynamic-css")?.getAttribute("href")
                    );
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
                    paginationWrapper.innerHTML = DOMPurify.sanitize( paginationHtml.innerHTML );
                    const currentPageData = paginationWrapper.querySelector('.ast-pagination-infinite');
                    currentPageData ? currentPageData.setAttribute('data-page', 2) : '';
                }
            }

           window.history.pushState({}, null, url);

            const gridLayout = astra.grid_layout;

            //	Append articles
            if( 1 == masonryEnabled && ( gridLayout.desktop > 1 || gridLayout.tablet > 1 || gridLayout.mobile > 1 ) ) {
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

            astNavigationListener();
        }

    return request;
}

function BlogBannerLayoutRender( data, titleSelector, value ) {
    // Heading for archive for layouts.
    const titleWrapper = document.querySelector(titleSelector);
    const titleHtml = data.querySelector(titleSelector);

    if ( titleWrapper && 'all' === value && (  'layout-2' !== blogArchiveTitleLayout || ! blogArchiveTitleOn ) ) {
        titleWrapper.remove();
        document.body.classList.remove('archive');
    } else if ( ! titleWrapper && titleHtml?.innerHTML ) {
        const mainSelector = 'layout-2' === blogArchiveTitleLayout ? '#content' : '#main';
        document.querySelector(mainSelector)?.insertAdjacentElement('beforebegin', titleHtml);
        document.body.classList.add('archive');
    } else if ( titleWrapper && titleHtml?.innerHTML ) {
        titleWrapper.innerHTML = DOMPurify.sanitize( titleHtml.innerHTML );
    }
}