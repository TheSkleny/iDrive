
const doRedirect = (path) => window.location.href = path;
export default {
    navbar: (route) => doRedirect(`/${route}`),
    searchLine: () => doRedirect('/search-line'),
    line: (id) => doRedirect(`/line/${id}`),
    vehicle: (id) => doRedirect(`/vehicle/${id}`),
}
