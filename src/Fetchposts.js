import { useEffect, useState } from 'react'

/** Getting posts data based on REST_API. */
export default function Fetchposts( restUrl ) {
    const [data, setData] = useState( null );

    useEffect(() => {
        async function loadData() {
            const response = await fetch( restUrl );
            if( ! response.ok ) {
                // oops! something went wrong.
                return;
            }

            const posts = await response.json();
            setData(posts);
        }

        loadData();
    }, [ restUrl ]);

    return data;
}
