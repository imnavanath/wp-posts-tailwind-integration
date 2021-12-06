import React from 'react';
import Fetchposts from '@Tailwind_Integration/Fetchposts';

export default function Posts() {
	const posts = Fetchposts( '/wp-json/wp/v2/posts' );
	console.error( posts );
	return (
		<section container spacing={2}>
			{posts && posts.map((post, index) => (
				<div item xs={4} key={index}>
					<div>
						<div>
							<span dangerouslySetInnerHTML={{__html: post.title.rendered}} />
							<span dangerouslySetInnerHTML={{__html: post.content.rendered}} />
						</div>
					</div>
				</div>
			))}
		</section>
	);
}
