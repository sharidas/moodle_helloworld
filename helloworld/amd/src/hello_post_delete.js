/**
 * @package local_helloworld
 * @copyright 2021 Sujith
 * @license GPLv3
 */

import Ajax from 'core/ajax';
import Config from 'core/config';

export const init = () => {

    document.body.addEventListener('click', (e) => {
        let values = [];
        const cardelements = e.target.parentNode.getElementsByClassName('card-text');
        if (e.target.nextElementSibling !== null) {
            const nextelementattr = e.target.nextElementSibling.attributes;
            if (cardelements.length === 2 && nextelementattr.length == 3) {
                values.push(e.target.nextElementSibling.attributes.getNamedItem('timecreated').value);
                values.push(e.target.nextElementSibling.attributes.getNamedItem('userid').value);
            }
            if (values.length == 2) {
                let promise = Ajax.call([
                    {
                        methodname: 'local_helloworld_delete_posts',
                        args: {timecreated: parseInt(values[0]), userid: parseInt(values[1])}
                    }
                ]);

                promise[0].then(function(results) {
                    window.console.log(results);
                    let redirect = Config.webroot + 'local/helloworld';
                    window.location.reload(redirect);
                }).fail(function (failure) {
                    window.console.log(failure);
                });
            }
        }
    });
};