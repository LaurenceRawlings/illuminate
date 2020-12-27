export default {
    methods: {
        backgroundImage(url) {
            return {
                'background-image': 'url(' + url + ')',
                'background-size': 'cover',
                'background-position': 'center'
            }
        },
    }
}
