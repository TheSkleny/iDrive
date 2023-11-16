
const doRedirect = (path) => window.location.href = path;
export default {
    searchLine: () => doRedirect('/search-line'),
    line: (id) => doRedirect(`/line/${id}`),
}
