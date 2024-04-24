'use server';

import { redirect } from 'next/navigation'

export async function useRedirect(url) {
    redirect(url);
}