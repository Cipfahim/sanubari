export default {
    methods: {
        route,
        // Get asset url
        asset(path) {
            return this.$page.props.app.url + '/' + path;
        },
        // Get storage file
        getFileUrl(path) {
            return this.$page.props.app.url + '/storage/' + path;
        },
        // Get error form nested array validation
        getNestedErrors(field, form) {
            const fields = Object.keys(form.errors).filter(key => key === field || key.startsWith(`${field}.`));

            const errors = fields.reduce((carry, key) => {
                carry.push(form.errors[key]);

                return carry;
            }, []);
            return errors[0] ? errors[0].replace(field, '') : '';
        },
        // Check active url
        isUrl(...urls) {
            if (urls[0] === '') {
                return this.url === ''
            }

            return urls.filter(url => location.pathname.startsWith(url)).length
        },
    }
}

