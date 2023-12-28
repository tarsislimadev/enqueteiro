jQuery(document).ready(function () {
    if (window.ViewModel) {
        viewModel = new window.ViewModel();
        ko.applyBindings(viewModel);

        if (viewModel.init) {
            viewModel.init();
        }
    }
});