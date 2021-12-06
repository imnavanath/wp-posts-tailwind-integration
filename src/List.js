import Fetchposts from '@Tailwind_Integration/Fetchposts';

export default function List() {

	const posts = Fetchposts( tailwind_integration_ui.rest_posts_url );

	return (
		<div className="flex flex-col">
		<div className="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
			<div className="py-2 align-middle inline-block min-w-full sm:px-6 lg:pl-8 lg:pr-0">
			<div className="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
				<table className="min-w-full border-2 border-dashed border-gray-200 divide-y divide-gray-200">
				<thead className="bg-gray-50">
					<tr>
					<th
						scope="col"
						className="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
					>
						Post Title
					</th>
					<th
						scope="col"
						className="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
					>
						Dates
					</th>
					<th
						scope="col"
						className="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
					>
						Categories, Tags
					</th>
					<th
						scope="col"
						className="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
					>
						Status
					</th>
					<th
						scope="col"
						className="pl-6 pr-0 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
					>
						Quick Links
					</th>
					</tr>
				</thead>
				<tbody className="bg-white divide-y divide-gray-200">
					{ posts && posts.map( ( post ) => (
						<tr key={ post.id }>
							<td className="px-4 py-4 whitespace-nowrap">
							<div className="flex items-center">
								<div className="flex-shrink-0 h-10 w-10">
									<img className="h-10 w-10 rounded-full border-1 border-solid border-gray-200 shadow" src={ post._embedded['wp:featuredmedia'] && post._embedded['wp:featuredmedia']['0'].source_url } alt="" />
								</div>
								<div className="ml-4">
									<div className="text-sm font-medium text-gray-900">{ post.title.rendered }</div>
									<div className="text-sm text-gray-500">Author - { post._embedded.author[0].name }</div>
								</div>
							</div>
							</td>
							<td className="px-4 py-4 whitespace-nowrap">
								<div className="text-sm text-gray-900">Published - { post.date }</div>
								<div className="text-sm text-gray-500">Updated - { post.modified }</div>
							</td>
							<td className="px-4 py-4 whitespace-nowrap">
								<div className="text-sm text-gray-900"> { post._embedded['wp:term']['0']['0'] && post._embedded['wp:term']['0']['0'].name } </div>
								<div className="text-sm text-gray-500"> { post._embedded['wp:term']['1']['0'] && post._embedded['wp:term']['1']['0'].name } </div>
							</td>
							<td className="px-4 py-4 whitespace-nowrap">
								<span className="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
									{ post.status.toUpperCase() }
								</span>
							</td>
							<td className="px-4 py-4 whitespace-nowrap text-sm font-medium">
								<a target="_blank" href={ tailwind_integration_ui.site_url + '?p=' + post.id } className="text-indigo-600 hover:text-indigo-900 mr-4">
									View
								</a>
								<a href={ tailwind_integration_ui.admin_url + 'post.php?post=' + post.id + '&action=edit' } className="text-indigo-600 hover:text-indigo-900">
									Edit
								</a>
							</td>
						</tr>
					) ) }
				</tbody>
				</table>
			</div>
			</div>
		</div>
		</div>
	)
}
