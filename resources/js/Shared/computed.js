export default {
    thumbnail() {
        return {
            'background-image': 'url(' + this.post.thumbnail + ')',
        }
    },
    icon() {
        return {
            'background-image': 'url(' + this.post.user_photo + ')',
        }
    }
}
